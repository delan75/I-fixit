"""
Views for the scrapers app.
"""
from django.shortcuts import render, get_object_or_404
from django.http import JsonResponse
from django.contrib.auth.decorators import login_required
from django.views.decorators.http import require_POST
from rest_framework.decorators import api_view, permission_classes
from rest_framework.permissions import IsAuthenticated
from rest_framework.response import Response
from rest_framework import status
from .models import AuctionSite, ScrapingJob
from .services import ScrapingService


@login_required
def scraping_job_list(request):
    """View to list all scraping jobs."""
    jobs = ScrapingJob.objects.all().order_by('-created_at')
    return render(request, 'scrapers/job_list.html', {'jobs': jobs})


@login_required
def scraping_job_detail(request, job_id):
    """View to show details of a scraping job."""
    job = get_object_or_404(ScrapingJob, id=job_id)
    return render(request, 'scrapers/job_detail.html', {'job': job})


@login_required
@require_POST
def run_scraping_job(request, job_id):
    """View to run a scraping job."""
    job = get_object_or_404(ScrapingJob, id=job_id)

    if job.status != ScrapingJob.Status.PENDING:
        return JsonResponse({
            'status': 'error',
            'message': 'Job cannot be run. Make sure it is in Pending status.'
        }, status=400)

    success = ScrapingService.run_scraping_job(job.id)

    if success:
        return JsonResponse({
            'status': 'success',
            'message': 'Scraping job run successfully.'
        })
    else:
        return JsonResponse({
            'status': 'error',
            'message': 'Failed to run scraping job.'
        }, status=500)


@login_required
@require_POST
def create_scraping_job(request, site_id):
    """View to create a scraping job for an auction site."""
    site = get_object_or_404(AuctionSite, id=site_id)

    job = ScrapingService.create_scraping_job(site.id, request.user.id)

    if job:
        return JsonResponse({
            'status': 'success',
            'message': 'Scraping job created successfully.',
            'job_id': job.id
        })
    else:
        return JsonResponse({
            'status': 'error',
            'message': 'Failed to create scraping job.'
        }, status=500)


@api_view(['POST'])
@permission_classes([IsAuthenticated])
def run_scraper_with_preferences(request, site_id):
    """
    API endpoint to run a scraper with user preferences.

    This endpoint allows users to run a scraper with their specific preferences,
    filtering opportunities based on criteria like make, model, year range,
    vehicle condition, etc.
    """
    # Get the user ID from the request
    user_id = request.user.id

    # Run the scraper with user preferences
    result = ScrapingService.run_scraper_with_preferences(site_id, user_id)

    if result['status'] == 'success':
        return Response(result, status=status.HTTP_200_OK)
    else:
        return Response(result, status=status.HTTP_400_BAD_REQUEST)
