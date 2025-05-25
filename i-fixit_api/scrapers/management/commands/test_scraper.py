from django.core.management.base import BaseCommand
from scrapers.models import AuctionSite, ScrapingJob
from scrapers.services import AuctionNationScraper
from api.models import Opportunity

class Command(BaseCommand):
    help = 'Test the AuctionNationScraper model extraction'

    def handle(self, *args, **options):
        # Find an AuctionNationScraper site
        site = AuctionSite.objects.filter(scraper_class='AuctionNationScraper').first()
        if not site:
            self.stdout.write(self.style.ERROR('No AuctionNationScraper site found'))
            # Create a test site
            site = AuctionSite.objects.create(
                name='Test Auction Nation',
                url='https://example.com',
                scraper_class='AuctionNationScraper',
                is_active=True
            )
            self.stdout.write(self.style.SUCCESS(f'Created test site: {site.name}'))
        else:
            self.stdout.write(self.style.SUCCESS(f'Found auction site: {site.name}'))
        
        # Create a test scraping job
        job = ScrapingJob.objects.create(auction_site=site)
        self.stdout.write(self.style.SUCCESS(f'Created scraping job: {job.id}'))
        
        # Create a test scraper
        scraper = AuctionNationScraper(site, job)
        
        # Test the scraper's dummy opportunity creation
        scraper.scrape()
        
        # Print recent opportunities to check model field
        self.stdout.write(self.style.SUCCESS('\nRecent opportunities:'))
        for opp in Opportunity.objects.all().order_by('-created_at')[:5]:
            self.stdout.write(f'ID: {opp.id}, Make: {opp.make}, Model: {opp.model}, Year: {opp.year}, Odometer: {opp.odometer}')
