from django.db import models
from django.utils.translation import gettext_lazy as _
from django.contrib.auth.models import User


class AuctionSite(models.Model):
    """Model representing an auction website to scrape."""

    class ScraperClass(models.TextChoices):
        SMD = 'SMDScraper', _('SMD Auctions')
        BIDVEST = 'BidvestScraper', _('Bidvest Auctions')
        AUCTION_NATION = 'AuctionNationScraper', _('Auction Nation')
        GOBID = 'GoBidScraper', _('GoBid.co.za')
        WEBIDDING = 'WeBiddingScraper', _('WeBidding.co.za')
        ALLSURPLUS = 'AllSurplusScraper', _('AllSurplus South Africa')

    name = models.CharField(max_length=100)
    url = models.URLField()
    description = models.TextField(blank=True, null=True)
    is_active = models.BooleanField(default=True)
    scraper_class = models.CharField(
        max_length=100,
        choices=ScraperClass.choices,
        default=ScraperClass.SMD
    )
    config = models.JSONField(blank=True, null=True)
    created_at = models.DateTimeField(auto_now_add=True)
    updated_at = models.DateTimeField(auto_now=True)

    def __str__(self):
        return self.name


class ScrapingJob(models.Model):
    """Model representing a scraping job."""

    class Status(models.TextChoices):
        PENDING = 'pending', _('Pending')
        RUNNING = 'running', _('Running')
        COMPLETED = 'completed', _('Completed')
        FAILED = 'failed', _('Failed')

    auction_site = models.ForeignKey(AuctionSite, on_delete=models.CASCADE, related_name='scraping_jobs')
    user = models.ForeignKey(User, on_delete=models.CASCADE, related_name='scraping_jobs', null=True, blank=True)
    status = models.CharField(
        max_length=20,
        choices=Status.choices,
        default=Status.PENDING
    )
    start_time = models.DateTimeField(blank=True, null=True)
    end_time = models.DateTimeField(blank=True, null=True)
    results = models.JSONField(blank=True, null=True)
    error_message = models.TextField(blank=True, null=True)
    opportunities_created = models.IntegerField(default=0)
    created_at = models.DateTimeField(auto_now_add=True)
    updated_at = models.DateTimeField(auto_now=True)

    def __str__(self):
        return f"Scraping job for {self.auction_site.name} ({self.get_status_display()})"
