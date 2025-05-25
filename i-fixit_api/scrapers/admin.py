from django.contrib import admin
from django.contrib import messages
from django.utils.html import format_html
from .models import ScrapingJob, AuctionSite
from .services import ScrapingService


@admin.register(AuctionSite)
class AuctionSiteAdmin(admin.ModelAdmin):
    """Admin interface for AuctionSite model."""
    list_display = ('name', 'url', 'scraper_class', 'is_active', 'created_at')
    list_filter = ('is_active', 'scraper_class')
    search_fields = ('name', 'url')
    actions = ['create_scraping_job']

    def create_scraping_job(self, request, queryset):
        """Create scraping jobs for selected auction sites."""
        jobs_created = 0
        for site in queryset:
            job = ScrapingService.create_scraping_job(site.id)
            if job:
                jobs_created += 1

        if jobs_created:
            self.message_user(
                request,
                f"{jobs_created} scraping job(s) created successfully.",
                messages.SUCCESS
            )
        else:
            self.message_user(
                request,
                "No scraping jobs were created.",
                messages.ERROR
            )

    create_scraping_job.short_description = "Create scraping jobs for selected sites"


@admin.register(ScrapingJob)
class ScrapingJobAdmin(admin.ModelAdmin):
    """Admin interface for ScrapingJob model."""
    list_display = ('id', 'auction_site', 'status', 'start_time', 'end_time',
                   'opportunities_created', 'run_job_button')
    list_filter = ('status', 'auction_site')
    readonly_fields = ('start_time', 'end_time', 'opportunities_created', 'results')
    actions = ['run_selected_jobs']

    def run_job_button(self, obj):
        """Button to run a scraping job."""
        if obj.status == ScrapingJob.Status.PENDING:
            return format_html(
                '<a class="button" href="{}">Run Job</a>',
                f'/admin/scrapers/scrapingjob/{obj.id}/run/'
            )
        return ""

    run_job_button.short_description = "Action"

    def run_selected_jobs(self, request, queryset):
        """Run selected scraping jobs."""
        jobs_run = 0
        for job in queryset.filter(status=ScrapingJob.Status.PENDING):
            success = ScrapingService.run_scraping_job(job.id)
            if success:
                jobs_run += 1

        if jobs_run:
            self.message_user(
                request,
                f"{jobs_run} scraping job(s) run successfully.",
                messages.SUCCESS
            )
        else:
            self.message_user(
                request,
                "No scraping jobs were run. Make sure jobs are in 'Pending' status.",
                messages.ERROR
            )

    run_selected_jobs.short_description = "Run selected scraping jobs"

    def get_urls(self):
        """Add custom URLs for the admin."""
        from django.urls import path
        urls = super().get_urls()
        custom_urls = [
            path('<path:object_id>/run/', self.admin_site.admin_view(self.run_job_view), name='scrapingjob-run'),
        ]
        return custom_urls + urls

    def run_job_view(self, request, object_id, *args, **kwargs):
        """View to run a scraping job."""
        from django.http import HttpResponseRedirect
        from django.urls import reverse

        job = self.get_object(request, object_id)
        if job and job.status == ScrapingJob.Status.PENDING:
            success = ScrapingService.run_scraping_job(job.id)
            if success:
                self.message_user(request, "Scraping job run successfully.", messages.SUCCESS)
            else:
                self.message_user(request, "Failed to run scraping job.", messages.ERROR)
        else:
            self.message_user(request, "Job cannot be run. Make sure it's in 'Pending' status.", messages.ERROR)

        return HttpResponseRedirect(reverse('admin:scrapers_scrapingjob_changelist'))
