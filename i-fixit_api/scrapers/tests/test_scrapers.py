"""
Tests for scrapers.
"""
from unittest.mock import patch, MagicMock
from django.test import TestCase
from selenium.webdriver.common.by import By
from selenium.common.exceptions import TimeoutException
from selenium.webdriver.support.ui import WebDriverWait

from scrapers.models import AuctionSite, ScrapingJob
from scrapers.services import ScraperFactory, ScrapingService, SMDScraper, BidvestScraper


class ScraperFactoryTest(TestCase):
    """Tests for ScraperFactory."""

    def setUp(self):
        """Set up test data."""
        self.auction_site_smd = AuctionSite.objects.create(
            name='SMD Auctions',
            url='https://www.smd.co.za',
            scraper_class='SMDScraper'
        )

        self.auction_site_bidvest = AuctionSite.objects.create(
            name='Bidvest Auctions',
            url='https://www.bidvestauctions.co.za',
            scraper_class='BidvestScraper'
        )

        self.scraping_job_smd = ScrapingJob.objects.create(
            auction_site=self.auction_site_smd
        )

        self.scraping_job_bidvest = ScrapingJob.objects.create(
            auction_site=self.auction_site_bidvest
        )

    def test_get_smd_scraper(self):
        """Test getting SMD scraper."""
        scraper = ScraperFactory.get_scraper(self.auction_site_smd, self.scraping_job_smd)
        self.assertIsInstance(scraper, SMDScraper)

    def test_get_bidvest_scraper(self):
        """Test getting Bidvest scraper."""
        scraper = ScraperFactory.get_scraper(self.auction_site_bidvest, self.scraping_job_bidvest)
        self.assertIsInstance(scraper, BidvestScraper)

    def test_get_unknown_scraper(self):
        """Test getting unknown scraper."""
        auction_site = AuctionSite.objects.create(
            name='Unknown Auctions',
            url='https://www.unknown.co.za',
            scraper_class='UnknownScraper'
        )

        scraping_job = ScrapingJob.objects.create(
            auction_site=auction_site
        )

        scraper = ScraperFactory.get_scraper(auction_site, scraping_job)
        self.assertIsNone(scraper)


class ScrapingServiceTest(TestCase):
    """Tests for ScrapingService."""

    def setUp(self):
        """Set up test data."""
        self.auction_site = AuctionSite.objects.create(
            name='SMD Auctions',
            url='https://www.smd.co.za',
            scraper_class='SMDScraper'
        )

    def test_create_scraping_job(self):
        """Test creating a scraping job."""
        scraping_job = ScrapingService.create_scraping_job(self.auction_site.id)

        self.assertIsNotNone(scraping_job)
        self.assertEqual(scraping_job.auction_site, self.auction_site)
        self.assertEqual(scraping_job.status, ScrapingJob.Status.PENDING)

    @patch('scrapers.services.ScraperFactory.get_scraper')
    def test_run_scraping_job_success(self, mock_get_scraper):
        """Test running a scraping job successfully."""
        # Create a scraping job
        scraping_job = ScrapingJob.objects.create(
            auction_site=self.auction_site
        )

        # Mock the scraper
        mock_scraper = MagicMock()
        mock_scraper.scrape.return_value = True
        mock_scraper.save_opportunities.return_value = 5
        mock_get_scraper.return_value = mock_scraper

        # Run the scraping job
        result = ScrapingService.run_scraping_job(scraping_job.id)

        # Refresh the scraping job from the database
        scraping_job.refresh_from_db()

        # Check the result
        self.assertTrue(result)
        self.assertEqual(scraping_job.status, ScrapingJob.Status.COMPLETED)
        self.assertEqual(scraping_job.opportunities_created, 5)
        self.assertIsNotNone(scraping_job.start_time)
        self.assertIsNotNone(scraping_job.end_time)

    @patch('scrapers.services.ScraperFactory.get_scraper')
    def test_run_scraping_job_failure(self, mock_get_scraper):
        """Test running a scraping job with failure."""
        # Create a scraping job
        scraping_job = ScrapingJob.objects.create(
            auction_site=self.auction_site
        )

        # Mock the scraper
        mock_scraper = MagicMock()
        mock_scraper.scrape.return_value = False
        mock_get_scraper.return_value = mock_scraper

        # Run the scraping job
        result = ScrapingService.run_scraping_job(scraping_job.id)

        # Refresh the scraping job from the database
        scraping_job.refresh_from_db()

        # Check the result
        self.assertFalse(result)
        self.assertEqual(scraping_job.status, ScrapingJob.Status.FAILED)
        self.assertIsNotNone(scraping_job.start_time)
        self.assertIsNotNone(scraping_job.end_time)

    @patch('scrapers.services.ScraperFactory.get_scraper')
    def test_run_scraping_job_no_scraper(self, mock_get_scraper):
        """Test running a scraping job with no scraper."""
        # Create a scraping job
        scraping_job = ScrapingJob.objects.create(
            auction_site=self.auction_site
        )

        # Mock the scraper factory to return None
        mock_get_scraper.return_value = None

        # Run the scraping job
        result = ScrapingService.run_scraping_job(scraping_job.id)

        # Refresh the scraping job from the database
        scraping_job.refresh_from_db()

        # Check the result
        self.assertFalse(result)
        self.assertEqual(scraping_job.status, ScrapingJob.Status.FAILED)
        self.assertEqual(scraping_job.error_message, "Failed to create scraper")
        self.assertIsNotNone(scraping_job.start_time)
        self.assertIsNotNone(scraping_job.end_time)


class SeleniumScraperTest(TestCase):
    """Tests for SeleniumScraper."""

    def setUp(self):
        """Set up test data."""
        self.auction_site = AuctionSite.objects.create(
            name='Test Auction Site',
            url='https://www.testauction.com',
            scraper_class='SMDScraper'
        )

        self.scraping_job = ScrapingJob.objects.create(
            auction_site=self.auction_site
        )

        # Create a test scraper that inherits from SeleniumScraper
        self.scraper = SMDScraper(self.auction_site, self.scraping_job)

    @patch('scrapers.services.webdriver.Chrome')
    def test_setup_driver(self, mock_chrome):
        """Test setting up the WebDriver."""
        # Mock the Chrome driver
        mock_driver = MagicMock()
        mock_chrome.return_value = mock_driver

        # Call setup_driver
        result = self.scraper.setup_driver()

        # Check the result
        self.assertTrue(result)
        self.assertEqual(self.scraper.driver, mock_driver)
        mock_driver.set_page_load_timeout.assert_called_once_with(30)

    @patch('scrapers.services.webdriver.Chrome')
    def test_setup_driver_exception(self, mock_chrome):
        """Test setting up the WebDriver with an exception."""
        # Mock the Chrome driver to raise an exception
        mock_chrome.side_effect = Exception("Test exception")

        # Call setup_driver
        result = self.scraper.setup_driver()

        # Check the result
        self.assertFalse(result)
        self.assertIsNone(self.scraper.driver)
        self.assertIn("Test exception", self.scraping_job.error_message)

    def test_cleanup(self):
        """Test cleaning up the WebDriver."""
        # Mock the driver
        mock_driver = MagicMock()
        self.scraper.driver = mock_driver

        # Call cleanup
        self.scraper.cleanup()

        # Check that the driver was quit
        mock_driver.quit.assert_called_once()

    def test_cleanup_with_exception(self):
        """Test cleaning up the WebDriver with an exception."""
        # Mock the driver to raise an exception when quit is called
        mock_driver = MagicMock()
        mock_driver.quit.side_effect = Exception("Test exception")
        self.scraper.driver = mock_driver

        # Call cleanup
        self.scraper.cleanup()

        # Check that quit was called despite the exception
        mock_driver.quit.assert_called_once()

    @patch('scrapers.services.SeleniumScraper.setup_driver')
    def test_safe_find_element(self, mock_setup_driver):
        """Test safely finding an element."""
        # Mock the driver and WebDriverWait
        mock_driver = MagicMock()
        self.scraper.driver = mock_driver

        with patch('scrapers.services.WebDriverWait') as mock_wait:
            # Mock the until method to return an element
            mock_wait.return_value.until.return_value = "test_element"

            # Call safe_find_element
            element = self.scraper.safe_find_element(By.ID, "test_id")

            # Check the result
            self.assertEqual(element, "test_element")
            mock_wait.assert_called_once_with(mock_driver, 10)

    @patch('scrapers.services.SeleniumScraper.setup_driver')
    def test_safe_find_element_with_parent(self, mock_setup_driver):
        """Test safely finding an element with a parent element."""
        # Mock the parent element and WebDriverWait
        mock_parent = MagicMock()

        with patch('scrapers.services.WebDriverWait') as mock_wait:
            # Mock the until method to return an element
            mock_wait.return_value.until.return_value = "test_element"

            # Call safe_find_element with parent
            element = self.scraper.safe_find_element(By.ID, "test_id", parent=mock_parent)

            # Check the result
            self.assertEqual(element, "test_element")
            mock_wait.assert_called_once_with(mock_parent, 10)

    @patch('scrapers.services.SeleniumScraper.setup_driver')
    def test_safe_find_element_exception(self, mock_setup_driver):
        """Test safely finding an element with an exception."""
        # Mock the driver and WebDriverWait
        mock_driver = MagicMock()
        self.scraper.driver = mock_driver

        with patch('scrapers.services.WebDriverWait') as mock_wait:
            # Mock the until method to raise an exception
            mock_wait.return_value.until.side_effect = TimeoutException("Test timeout")

            # Call safe_find_element
            element = self.scraper.safe_find_element(By.ID, "test_id")

            # Check the result
            self.assertIsNone(element)

    @patch('scrapers.services.SeleniumScraper.setup_driver')
    def test_safe_find_elements(self, mock_setup_driver):
        """Test safely finding elements."""
        # Mock the driver, WebDriverWait, and find_elements
        mock_driver = MagicMock()
        mock_driver.find_elements.return_value = ["element1", "element2"]
        self.scraper.driver = mock_driver

        with patch('scrapers.services.WebDriverWait') as mock_wait:
            # Call safe_find_elements
            elements = self.scraper.safe_find_elements(By.CLASS_NAME, "test_class")

            # Check the result
            self.assertEqual(elements, ["element1", "element2"])
            mock_wait.assert_called_once_with(mock_driver, 10)
            mock_driver.find_elements.assert_called_once_with(By.CLASS_NAME, "test_class")

    @patch('scrapers.services.SeleniumScraper.setup_driver')
    def test_safe_find_elements_exception(self, mock_setup_driver):
        """Test safely finding elements with an exception."""
        # Mock the driver and WebDriverWait
        mock_driver = MagicMock()
        self.scraper.driver = mock_driver

        with patch('scrapers.services.WebDriverWait') as mock_wait:
            # Mock the until method to raise an exception
            mock_wait.return_value.until.side_effect = TimeoutException("Test timeout")

            # Call safe_find_elements
            elements = self.scraper.safe_find_elements(By.CLASS_NAME, "test_class")

            # Check the result
            self.assertEqual(elements, [])


class BeautifulSoupScraperTest(TestCase):
    """Tests for BeautifulSoupScraper."""

    def setUp(self):
        """Set up test data."""
        self.auction_site = AuctionSite.objects.create(
            name='Test Auction Site',
            url='https://www.testauction.com',
            scraper_class='BidvestScraper'
        )

        self.scraping_job = ScrapingJob.objects.create(
            auction_site=self.auction_site
        )

        # Create a test scraper that inherits from BeautifulSoupScraper
        self.scraper = BidvestScraper(self.auction_site, self.scraping_job)

    @patch('scrapers.services.requests.get')
    def test_get_page_content(self, mock_get):
        """Test getting page content."""
        # Mock the response
        mock_response = MagicMock()
        mock_response.text = "<html><body>Test content</body></html>"
        mock_get.return_value = mock_response

        # Call get_page_content
        content = self.scraper.get_page_content("https://www.testauction.com")

        # Check the result
        self.assertEqual(content, "<html><body>Test content</body></html>")
        mock_get.assert_called_once()
        self.assertEqual(mock_get.call_args[0][0], "https://www.testauction.com")

    @patch('scrapers.services.requests.get')
    def test_get_page_content_exception(self, mock_get):
        """Test getting page content with an exception."""
        # Mock the get method to raise an exception
        mock_get.side_effect = Exception("Test exception")

        # Call get_page_content
        content = self.scraper.get_page_content("https://www.testauction.com")

        # Check the result
        self.assertIsNone(content)


class OpportunityScoreTest(TestCase):
    """Tests for opportunity scoring."""

    def setUp(self):
        """Set up test data."""
        from api.services import OpportunityService
        self.opportunity_service = OpportunityService

    def test_calculate_opportunity_score_with_minimal_data(self):
        """Test calculating opportunity score with minimal data."""
        # Create minimal opportunity data
        opportunity_data = {
            'make': 'Toyota',
            'model': 'Corolla',
            'year': 2020,
            'has_keys': True,
            'vehicle_starts': True
        }

        # Call _calculate_opportunity_score
        score = self.opportunity_service._calculate_opportunity_score(opportunity_data)

        # Check that the score is within the expected range
        self.assertGreaterEqual(score, 0)
        self.assertLessEqual(score, 100)

        # Toyota is a popular make and 2020 is a recent year, so score should be relatively high
        self.assertGreaterEqual(score, 70)

    def test_calculate_opportunity_score_with_old_vehicle(self):
        """Test calculating opportunity score with an old vehicle."""
        # Create data for an old vehicle
        opportunity_data = {
            'make': 'Fiat',
            'model': 'Uno',
            'year': 1995,
            'has_keys': False,
            'vehicle_starts': False
        }

        # Call _calculate_opportunity_score
        score = self.opportunity_service._calculate_opportunity_score(opportunity_data)

        # Check that the score is within the expected range
        self.assertGreaterEqual(score, 0)
        self.assertLessEqual(score, 100)

        # Fiat is not a popular make, 1995 is an old year, and no keys/doesn't start
        # So score should be relatively low
        self.assertLessEqual(score, 40)

    def test_calculate_opportunity_score_with_luxury_vehicle(self):
        """Test calculating opportunity score with a luxury vehicle."""
        # Create data for a luxury vehicle
        opportunity_data = {
            'make': 'BMW',
            'model': 'X5',
            'year': 2022,
            'has_keys': True,
            'vehicle_starts': True
        }

        # Call _calculate_opportunity_score
        score = self.opportunity_service._calculate_opportunity_score(opportunity_data)

        # Check that the score is within the expected range
        self.assertGreaterEqual(score, 0)
        self.assertLessEqual(score, 100)

        # BMW is a luxury make and 2022 is a very recent year, so score should be high
        self.assertGreaterEqual(score, 75)

    def test_calculate_opportunity_score_with_complete_data(self):
        """Test calculating opportunity score with complete data using OpportunityService."""
        from api.services import OpportunityService

        # Create complete opportunity data
        opportunity_data = {
            'make': 'Toyota',
            'model': 'Corolla',
            'year': 2020,
            'has_keys': True,
            'vehicle_starts': True,
            'has_battery': True,
            'has_spare_wheel': True,
            'vehicle_code': '2',  # Used vehicle
            'current_bid': 80000,
            'estimated_repair_cost': 20000,
            'estimated_market_value': 150000,
            'potential_profit': 50000,
            'odometer': '50000 km'
        }

        # Call _calculate_opportunity_score
        score = OpportunityService._calculate_opportunity_score(opportunity_data)

        # Check that the score is within the expected range
        self.assertGreaterEqual(score, 0)
        self.assertLessEqual(score, 100)

        # This is an ideal opportunity with high profit potential, so score should be very high
        self.assertGreaterEqual(score, 85)