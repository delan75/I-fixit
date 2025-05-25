"""
Tests for API views.
"""
from django.urls import reverse
from django.contrib.auth.models import User
from rest_framework import status
from rest_framework.test import APITestCase, APIClient
from rest_framework_simplejwt.tokens import RefreshToken

from api.models import Car, Opportunity, UserPreference


class CarViewSetTest(APITestCase):
    """Tests for CarViewSet."""
    
    def setUp(self):
        """Set up test data."""
        self.user = User.objects.create_user(
            username='testuser',
            email='test@example.com',
            password='testpassword'
        )
        
        self.admin_user = User.objects.create_user(
            username='adminuser',
            email='admin@example.com',
            password='adminpassword',
            is_staff=True
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
        
        # Get tokens for authentication
        self.user_token = self.get_tokens_for_user(self.user)
        self.admin_token = self.get_tokens_for_user(self.admin_user)
        
        # Set up client with user authentication
        self.client = APIClient()
        self.client.credentials(HTTP_AUTHORIZATION=f'Bearer {self.user_token}')
    
    def get_tokens_for_user(self, user):
        """Get JWT tokens for a user."""
        refresh = RefreshToken.for_user(user)
        return str(refresh.access_token)
    
    def test_list_cars(self):
        """Test listing cars."""
        url = reverse('car-list')
        response = self.client.get(url)
        
        self.assertEqual(response.status_code, status.HTTP_200_OK)
        self.assertEqual(response.data['status'], 'success')
        self.assertEqual(len(response.data['data']), 1)
    
    def test_retrieve_car(self):
        """Test retrieving a car."""
        url = reverse('car-detail', args=[self.car.id])
        response = self.client.get(url)
        
        self.assertEqual(response.status_code, status.HTTP_200_OK)
        self.assertEqual(response.data['status'], 'success')
        self.assertEqual(response.data['data']['id'], self.car.id)
        self.assertEqual(response.data['data']['make'], 'Toyota')
    
    def test_create_car(self):
        """Test creating a car."""
        url = reverse('car-list')
        data = {
            'make': 'Honda',
            'model': 'Civic',
            'year': 2020,
            'body_type': 'Sedan',
            'fuel_type': 'Petrol',
            'transmission': 'Automatic',
            'mileage': 40000,
            'purchase_date': '2023-02-01',
            'purchase_price': 120000,
            'damage_description': 'Front bumper damage'
        }
        
        response = self.client.post(url, data, format='json')
        
        self.assertEqual(response.status_code, status.HTTP_201_CREATED)
        self.assertEqual(response.data['status'], 'success')
        self.assertEqual(response.data['data']['make'], 'Honda')
        self.assertEqual(response.data['data']['model'], 'Civic')
    
    def test_update_car(self):
        """Test updating a car."""
        url = reverse('car-detail', args=[self.car.id])
        data = {
            'mileage': 55000,
            'current_phase': 'fixing'
        }
        
        response = self.client.put(url, data, format='json')
        
        self.assertEqual(response.status_code, status.HTTP_200_OK)
        self.assertEqual(response.data['status'], 'success')
        self.assertEqual(response.data['data']['mileage'], 55000)
        self.assertEqual(response.data['data']['current_phase'], 'fixing')
    
    def test_delete_car(self):
        """Test deleting a car."""
        url = reverse('car-detail', args=[self.car.id])
        response = self.client.delete(url)
        
        self.assertEqual(response.status_code, status.HTTP_204_NO_CONTENT)
        self.assertEqual(Car.objects.count(), 0)
    
    def test_financial_summary(self):
        """Test getting financial summary for a car."""
        url = reverse('car-financial-summary', args=[self.car.id])
        response = self.client.get(url)
        
        self.assertEqual(response.status_code, status.HTTP_200_OK)
        self.assertEqual(response.data['status'], 'success')
        self.assertEqual(response.data['data']['car_id'], self.car.id)
        self.assertEqual(response.data['data']['make'], 'Toyota')
        self.assertEqual(response.data['data']['purchase_price'], '100000.00')


class OpportunityViewSetTest(APITestCase):
    """Tests for OpportunityViewSet."""
    
    def setUp(self):
        """Set up test data."""
        self.user = User.objects.create_user(
            username='testuser',
            email='test@example.com',
            password='testpassword'
        )
        
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
        
        # Get token for authentication
        self.token = self.get_tokens_for_user(self.user)
        
        # Set up client with authentication
        self.client = APIClient()
        self.client.credentials(HTTP_AUTHORIZATION=f'Bearer {self.token}')
    
    def get_tokens_for_user(self, user):
        """Get JWT tokens for a user."""
        refresh = RefreshToken.for_user(user)
        return str(refresh.access_token)
    
    def test_list_opportunities(self):
        """Test listing opportunities."""
        url = reverse('opportunity-list')
        response = self.client.get(url)
        
        self.assertEqual(response.status_code, status.HTTP_200_OK)
        self.assertEqual(response.data['status'], 'success')
        self.assertEqual(len(response.data['data']), 1)
    
    def test_create_opportunity(self):
        """Test creating an opportunity."""
        url = reverse('opportunity-list')
        data = {
            'source': 'Bidvest',
            'listing_url': 'https://example.com/listing/456',
            'make': 'Honda',
            'model': 'Civic',
            'year': 2020,
            'current_bid': 90000,
            'damage_description': 'Front bumper damage',
            'estimated_repair_cost': 25000,
            'estimated_market_value': 160000,
            'potential_profit': 45000,
            'opportunity_score': 80
        }
        
        response = self.client.post(url, data, format='json')
        
        self.assertEqual(response.status_code, status.HTTP_201_CREATED)
        self.assertEqual(response.data['status'], 'success')
        self.assertEqual(response.data['data']['make'], 'Honda')
        self.assertEqual(response.data['data']['model'], 'Civic')


class UserPreferenceViewSetTest(APITestCase):
    """Tests for UserPreferenceViewSet."""
    
    def setUp(self):
        """Set up test data."""
        self.user = User.objects.create_user(
            username='testuser',
            email='test@example.com',
            password='testpassword'
        )
        
        # Get token for authentication
        self.token = self.get_tokens_for_user(self.user)
        
        # Set up client with authentication
        self.client = APIClient()
        self.client.credentials(HTTP_AUTHORIZATION=f'Bearer {self.token}')
    
    def get_tokens_for_user(self, user):
        """Get JWT tokens for a user."""
        refresh = RefreshToken.for_user(user)
        return str(refresh.access_token)
    
    def test_create_preference(self):
        """Test creating user preferences."""
        url = reverse('preference-list')
        data = {
            'preferred_makes': ['Toyota', 'Honda'],
            'preferred_models': ['Corolla', 'Civic'],
            'min_year': 2015,
            'max_year': 2022,
            'min_profit': 30000,
            'max_investment': 200000,
            'notification_email': True,
            'notification_sms': False,
            'notification_app': True
        }
        
        response = self.client.post(url, data, format='json')
        
        self.assertEqual(response.status_code, status.HTTP_200_OK)
        self.assertEqual(response.data['status'], 'success')
        self.assertEqual(response.data['data']['preferred_makes'], ['Toyota', 'Honda'])
        self.assertEqual(response.data['data']['min_year'], 2015)
    
    def test_get_preference(self):
        """Test getting user preferences."""
        # Create preference first
        UserPreference.objects.create(
            user=self.user,
            preferred_makes=['Toyota', 'Honda'],
            preferred_models=['Corolla', 'Civic'],
            min_year=2015,
            max_year=2022,
            min_profit=30000,
            max_investment=200000
        )
        
        url = reverse('preference-list')
        response = self.client.get(url)
        
        self.assertEqual(response.status_code, status.HTTP_200_OK)
        self.assertEqual(response.data['status'], 'success')
        self.assertEqual(response.data['data']['preferred_makes'], ['Toyota', 'Honda'])
        self.assertEqual(response.data['data']['min_year'], 2015)
