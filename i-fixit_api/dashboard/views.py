from django.shortcuts import render, redirect, get_object_or_404
from django.contrib.auth.decorators import login_required
from django.contrib.auth import login, logout
from django.contrib.auth.forms import AuthenticationForm
from django.contrib import messages
from django.http import JsonResponse
from django.views.decorators.http import require_POST
from django.db.models import Count, Avg, Sum, Q
from django.utils import timezone

from api.models import Opportunity, Car
from scrapers.models import AuctionSite, ScrapingJob
from scrapers.services import ScrapingService


@login_required
def index(request):
    """Dashboard index view."""
    # Get counts for summary cards
    total_opportunities = Opportunity.objects.count()
    new_opportunities = Opportunity.objects.filter(status=Opportunity.Status.NEW).count()
    interested_opportunities = Opportunity.objects.filter(status=Opportunity.Status.INTERESTED).count()
    bidding_opportunities = Opportunity.objects.filter(status=Opportunity.Status.BIDDING).count()

    # Get recent opportunities
    recent_opportunities = Opportunity.objects.all().order_by('-created_at')[:5]

    # Get recent scraping jobs
    recent_jobs = ScrapingJob.objects.all().order_by('-created_at')[:5]

    # Get opportunity counts by source
    opportunities_by_source = Opportunity.objects.values('source').annotate(count=Count('id')).order_by('-count')

    # Get opportunity counts by status
    opportunities_by_status = Opportunity.objects.values('status').annotate(count=Count('id')).order_by('status')

    context = {
        'total_opportunities': total_opportunities,
        'new_opportunities': new_opportunities,
        'interested_opportunities': interested_opportunities,
        'bidding_opportunities': bidding_opportunities,
        'recent_opportunities': recent_opportunities,
        'recent_jobs': recent_jobs,
        'opportunities_by_source': opportunities_by_source,
        'opportunities_by_status': opportunities_by_status,
    }

    return render(request, 'dashboard/index.html', context)


@login_required
def opportunities(request):
    """View to list all opportunities with filtering."""
    # Get filter parameters from request
    make = request.GET.get('make', '')
    model = request.GET.get('model', '')
    year = request.GET.get('year', '')
    status = request.GET.get('status', '')
    min_score = request.GET.get('min_score', '')
    source = request.GET.get('source', '')
    sort_by = request.GET.get('sort_by', '-opportunity_score')

    # Start with all opportunities
    opportunities = Opportunity.objects.all()

    # Apply filters
    if make:
        opportunities = opportunities.filter(make__icontains=make)
    if model:
        opportunities = opportunities.filter(model__icontains=model)
    if year:
        opportunities = opportunities.filter(year=year)
    if status:
        opportunities = opportunities.filter(status=status)
    if min_score:
        opportunities = opportunities.filter(opportunity_score__gte=min_score)
    if source:
        opportunities = opportunities.filter(source=source)

    # Apply sorting
    opportunities = opportunities.order_by(sort_by)

    # Get unique values for filter dropdowns
    all_makes = Opportunity.objects.values_list('make', flat=True).distinct()
    all_models = Opportunity.objects.values_list('model', flat=True).distinct()
    all_years = Opportunity.objects.values_list('year', flat=True).distinct().order_by('-year')
    all_sources = Opportunity.objects.values_list('source', flat=True).distinct()

    context = {
        'opportunities': opportunities,
        'all_makes': all_makes,
        'all_models': all_models,
        'all_years': all_years,
        'all_sources': all_sources,
        'status_choices': Opportunity.Status.choices,
        'vehicle_code_choices': Opportunity.VehicleCode.choices,
        'filters': {
            'make': make,
            'model': model,
            'year': year,
            'status': status,
            'min_score': min_score,
            'source': source,
            'sort_by': sort_by,
        }
    }

    return render(request, 'dashboard/opportunities.html', context)


@login_required
def opportunity_detail(request, opportunity_id):
    """View to show details of an opportunity."""
    opportunity = get_object_or_404(Opportunity, id=opportunity_id)

    # Mark as viewed if it's new
    if opportunity.status == Opportunity.Status.NEW:
        opportunity.status = Opportunity.Status.VIEWED
        opportunity.save()

    # Calculate vehicle age
    vehicle_age = 0
    if opportunity.year:
        current_year = 2025  # Update this as needed
        vehicle_age = current_year - opportunity.year

    context = {
        'opportunity': opportunity,
        'status_choices': Opportunity.Status.choices,
        'vehicle_age': vehicle_age,
    }

    return render(request, 'dashboard/opportunity_detail.html', context)


@login_required
@require_POST
def update_opportunity_status(request, opportunity_id):
    """View to update the status of an opportunity."""
    opportunity = get_object_or_404(Opportunity, id=opportunity_id)
    new_status = request.POST.get('status')

    if new_status in dict(Opportunity.Status.choices):
        opportunity.status = new_status
        opportunity.save()

        return JsonResponse({
            'status': 'success',
            'status_display': opportunity.get_status_display(),
        })

    return JsonResponse({
        'status': 'error',
        'message': 'Invalid status',
    }, status=400)


@login_required
def scrapers(request):
    """View to list all auction sites and scraping jobs."""
    auction_sites = AuctionSite.objects.all()
    scraping_jobs = ScrapingJob.objects.all().order_by('-created_at')

    context = {
        'auction_sites': auction_sites,
        'scraping_jobs': scraping_jobs,
    }

    return render(request, 'dashboard/scrapers.html', context)


@login_required
@require_POST
def run_scraper(request, site_id):
    """View to run a scraper for an auction site."""
    site = get_object_or_404(AuctionSite, id=site_id)

    job = ScrapingService.create_scraping_job(site.id, request.user.id)

    if job:
        # Run the job
        success = ScrapingService.run_scraping_job(job.id)

        if success:
            messages.success(request, f"Scraping job for {site.name} completed successfully.")
        else:
            messages.error(request, f"Scraping job for {site.name} failed.")
    else:
        messages.error(request, f"Failed to create scraping job for {site.name}.")

    return redirect('dashboard:scrapers')


@login_required
@require_POST
def run_scraper_with_preferences(request, site_id):
    """View to run a scraper with user preferences."""
    site = get_object_or_404(AuctionSite, id=site_id)
    user = request.user

    # Process form data to update user preferences
    from api.models import UserPreference

    # Get or create user preferences
    user_preference, created = UserPreference.objects.get_or_create(user=user)

    # Update basic vehicle preferences
    if 'preferred_makes' in request.POST:
        preferred_makes = request.POST.getlist('preferred_makes')
        if preferred_makes:
            user_preference.preferred_makes = preferred_makes

    if 'preferred_models' in request.POST:
        preferred_models = request.POST.get('preferred_models')
        if preferred_models:
            # Convert comma-separated string to list
            user_preference.preferred_models = [model.strip() for model in preferred_models.split(',')]

    if 'min_year' in request.POST and request.POST.get('min_year'):
        user_preference.min_year = int(request.POST.get('min_year'))

    if 'max_year' in request.POST and request.POST.get('max_year'):
        user_preference.max_year = int(request.POST.get('max_year'))

    # Update vehicle condition preferences
    if 'preferred_vehicle_codes' in request.POST:
        preferred_vehicle_codes = request.POST.getlist('preferred_vehicle_codes')
        if preferred_vehicle_codes:
            user_preference.preferred_vehicle_codes = preferred_vehicle_codes

    user_preference.require_keys = 'require_keys' in request.POST
    user_preference.require_starts = 'require_starts' in request.POST
    user_preference.require_battery = 'require_battery' in request.POST
    user_preference.require_spare_wheel = 'require_spare_wheel' in request.POST

    # Update financial preferences
    if 'min_profit' in request.POST and request.POST.get('min_profit'):
        user_preference.min_profit = float(request.POST.get('min_profit'))

    if 'max_investment' in request.POST and request.POST.get('max_investment'):
        user_preference.max_investment = float(request.POST.get('max_investment'))

    # Update mileage preferences
    if 'max_mileage' in request.POST and request.POST.get('max_mileage'):
        user_preference.max_mileage = int(request.POST.get('max_mileage'))

    if 'max_annual_mileage' in request.POST and request.POST.get('max_annual_mileage'):
        user_preference.max_annual_mileage = int(request.POST.get('max_annual_mileage'))

    # Save user preferences
    user_preference.save()

    # Run the scraper with user preferences
    result = ScrapingService.run_scraper_with_preferences(site_id, user.id)

    if result['status'] == 'success':
        messages.success(request, f"Scraping job for {site.name} completed successfully with your preferences.")
    else:
        messages.error(request, f"Scraping job for {site.name} failed: {result['message']}")

    return redirect('dashboard:scrapers')


def login_view(request):
    """Login view."""
    if request.method == 'POST':
        form = AuthenticationForm(request, data=request.POST)
        if form.is_valid():
            user = form.get_user()
            login(request, user)
            messages.success(request, f"Welcome back, {user.username}!")
            return redirect('dashboard:index')
    else:
        form = AuthenticationForm()

    return render(request, 'dashboard/login.html', {'form': form})


@login_required
def logout_view(request):
    """Logout view."""
    logout(request)
    messages.info(request, "You have been logged out.")
    return redirect('dashboard:login')
