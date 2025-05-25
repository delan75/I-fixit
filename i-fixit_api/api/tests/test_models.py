"""
Tests for API models.
"""
from django.test import TestCase
from django.contrib.auth.models import User
from api.models import Car, Part, Supplier, Opportunity, UserPreference


class CarModelTest(TestCase):
    """Tests for Car model."""
    
    def setUp(self):
        """Set up test data."""
        self.user = User.objects.create_user(
            username='testuser',
            email='test@example.com',
            password='testpassword'
        )
        
        self.car = Car.objects.create(
            user=self.user,
            make='Toyota',
            model='Corolla',
            year=2019,
            body_type='Sedan',
            fuel_type='Petrol',
            transmission='Automatic',
            mileage=50000,
            purchase_date='2023-01-01',
            purchase_price=100000,
            damage_description='Minor rear bumper damage'
        )
    
    def test_car_creation(self):
        """Test car creation."""
        self.assertEqual(self.car.make, 'Toyota')
        self.assertEqual(self.car.model, 'Corolla')
        self.assertEqual(self.car.year, 2019)
        self.assertEqual(self.car.user, self.user)
        self.assertEqual(self.car.current_phase, Car.CurrentPhase.BIDDING)
    
    def test_car_string_representation(self):
        """Test car string representation."""
        self.assertEqual(str(self.car), '2019 Toyota Corolla')


class PartModelTest(TestCase):
    """Tests for Part model."""
    
    def setUp(self):
        """Set up test data."""
        self.user = User.objects.create_user(
            username='testuser',
            email='test@example.com',
            password='testpassword'
        )
        
        self.car = Car.objects.create(
            user=self.user,
            make='Toyota',
            model='Corolla',
            year=2019,
            body_type='Sedan',
            fuel_type='Petrol',
            transmission='Automatic',
            mileage=50000,
            purchase_date='2023-01-01',
            purchase_price=100000,
            damage_description='Minor rear bumper damage'
        )
        
        self.supplier = Supplier.objects.create(
            name='Test Supplier',
            contact_person='John Doe',
            phone='1234567890',
            email='supplier@example.com'
        )
        
        self.part = Part.objects.create(
            car=self.car,
            name='Rear Bumper',
            description='OEM replacement bumper',
            condition=Part.Condition.NEW,
            quantity=1,
            unit_price=5000,
            total_price=5000,
            purchase_date='2023-01-15',
            supplier=self.supplier
        )
    
    def test_part_creation(self):
        """Test part creation."""
        self.assertEqual(self.part.name, 'Rear Bumper')
        self.assertEqual(self.part.car, self.car)
        self.assertEqual(self.part.supplier, self.supplier)
        self.assertEqual(self.part.total_price, 5000)
    
    def test_part_string_representation(self):
        """Test part string representation."""
        self.assertEqual(str(self.part), 'Rear Bumper for 2019 Toyota Corolla')


class OpportunityModelTest(TestCase):
    """Tests for Opportunity model."""
    
    def setUp(self):
        """Set up test data."""
        self.opportunity = Opportunity.objects.create(
            source='SMD',
            listing_url='https://example.com/listing/123',
            make='Toyota',
            model='Corolla',
            year=2019,
            current_bid=80000,
            damage_description='Rear bumper damage',
            estimated_repair_cost=20000,
            estimated_market_value=150000,
            potential_profit=50000,
            opportunity_score=85
        )
    
    def test_opportunity_creation(self):
        """Test opportunity creation."""
        self.assertEqual(self.opportunity.make, 'Toyota')
        self.assertEqual(self.opportunity.model, 'Corolla')
        self.assertEqual(self.opportunity.year, 2019)
        self.assertEqual(self.opportunity.opportunity_score, 85)
        self.assertEqual(self.opportunity.status, Opportunity.Status.NEW)
    
    def test_opportunity_string_representation(self):
        """Test opportunity string representation."""
        self.assertEqual(str(self.opportunity), '2019 Toyota Corolla - Score: 85')


class UserPreferenceModelTest(TestCase):
    """Tests for UserPreference model."""
    
    def setUp(self):
        """Set up test data."""
        self.user = User.objects.create_user(
            username='testuser',
            email='test@example.com',
            password='testpassword'
        )
        
        self.preference = UserPreference.objects.create(
            user=self.user,
            preferred_makes=['Toyota', 'Honda'],
            preferred_models=['Corolla', 'Civic'],
            min_year=2015,
            max_year=2022,
            min_profit=30000,
            max_investment=200000,
            notification_email=True,
            notification_sms=False,
            notification_app=True
        )
    
    def test_preference_creation(self):
        """Test preference creation."""
        self.assertEqual(self.preference.user, self.user)
        self.assertEqual(self.preference.preferred_makes, ['Toyota', 'Honda'])
        self.assertEqual(self.preference.preferred_models, ['Corolla', 'Civic'])
        self.assertEqual(self.preference.min_year, 2015)
        self.assertEqual(self.preference.max_investment, 200000)
    
    def test_preference_string_representation(self):
        """Test preference string representation."""
        self.assertEqual(str(self.preference), 'Preferences for testuser')
