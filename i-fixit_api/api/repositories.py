"""
Repository layer for the API.
This layer is responsible for data access and manipulation.
"""
from django.db.models import Sum, F, ExpressionWrapper, DecimalField, Avg, Count
from django.db.models.functions import Coalesce
from .models import Car, CarImage, Part, Supplier, Labor, Painting, Sale, Document, DamagedPart, Opportunity, UserPreference


class CarRepository:
    """Repository for Car model."""
    
    @staticmethod
    def get_all_cars(filters=None):
        """
        Get all cars with optional filtering.
        
        Args:
            filters (dict): Optional filters to apply
            
        Returns:
            QuerySet: Filtered cars
        """
        queryset = Car.objects.all()
        
        if filters:
            if 'make' in filters:
                queryset = queryset.filter(make__icontains=filters['make'])
            if 'model' in filters:
                queryset = queryset.filter(model__icontains=filters['model'])
            if 'year' in filters:
                queryset = queryset.filter(year=filters['year'])
            if 'current_phase' in filters:
                queryset = queryset.filter(current_phase=filters['current_phase'])
            if 'user_id' in filters:
                queryset = queryset.filter(user_id=filters['user_id'])
        
        return queryset
    
    @staticmethod
    def get_car_by_id(car_id):
        """
        Get a car by ID.
        
        Args:
            car_id (int): Car ID
            
        Returns:
            Car: Car instance or None
        """
        try:
            return Car.objects.get(id=car_id)
        except Car.DoesNotExist:
            return None
    
    @staticmethod
    def create_car(car_data):
        """
        Create a new car.
        
        Args:
            car_data (dict): Car data
            
        Returns:
            Car: Created car instance
        """
        return Car.objects.create(**car_data)
    
    @staticmethod
    def update_car(car, car_data):
        """
        Update a car.
        
        Args:
            car (Car): Car instance
            car_data (dict): Car data
            
        Returns:
            Car: Updated car instance
        """
        for key, value in car_data.items():
            setattr(car, key, value)
        car.save()
        return car
    
    @staticmethod
    def delete_car(car):
        """
        Delete a car.
        
        Args:
            car (Car): Car instance
            
        Returns:
            bool: True if deleted, False otherwise
        """
        car.delete()
        return True
    
    @staticmethod
    def get_car_financial_summary(car_id):
        """
        Get financial summary for a car.
        
        Args:
            car_id (int): Car ID
            
        Returns:
            dict: Financial summary
        """
        car = Car.objects.get(id=car_id)
        
        # Calculate parts cost
        parts_cost = Part.objects.filter(car_id=car_id).aggregate(
            total=Coalesce(Sum('total_price'), 0, output_field=DecimalField())
        )['total'] or 0
        
        # Calculate labor cost
        labor_cost = Labor.objects.filter(car_id=car_id).aggregate(
            total=Coalesce(Sum('total_cost'), 0, output_field=DecimalField())
        )['total'] or 0
        
        # Calculate painting cost
        painting_cost = Painting.objects.filter(car_id=car_id).aggregate(
            total=Coalesce(Sum('total_cost'), 0, output_field=DecimalField())
        )['total'] or 0
        
        # Get sale information if available
        try:
            sale = Sale.objects.get(car_id=car_id)
            selling_price = sale.selling_price
            dealership_commission = sale.dealership_commission
        except Sale.DoesNotExist:
            selling_price = 0
            dealership_commission = 0
        
        # Calculate total investment
        total_investment = car.purchase_price + parts_cost + labor_cost + painting_cost
        
        # Calculate profit/loss
        profit_loss = selling_price - total_investment - dealership_commission
        
        # Calculate ROI percentage
        roi_percentage = (profit_loss / total_investment * 100) if total_investment > 0 else 0
        
        return {
            'car_id': car_id,
            'make': car.make,
            'model': car.model,
            'year': car.year,
            'purchase_price': car.purchase_price,
            'parts_cost': parts_cost,
            'labor_cost': labor_cost,
            'painting_cost': painting_cost,
            'total_investment': total_investment,
            'selling_price': selling_price,
            'dealership_commission': dealership_commission,
            'profit_loss': profit_loss,
            'roi_percentage': roi_percentage
        }


class PartRepository:
    """Repository for Part model."""
    
    @staticmethod
    def get_parts_by_car_id(car_id):
        """
        Get parts for a specific car.
        
        Args:
            car_id (int): Car ID
            
        Returns:
            QuerySet: Parts for the car
        """
        return Part.objects.filter(car_id=car_id)
    
    @staticmethod
    def create_part(part_data):
        """
        Create a new part.
        
        Args:
            part_data (dict): Part data
            
        Returns:
            Part: Created part instance
        """
        return Part.objects.create(**part_data)


class OpportunityRepository:
    """Repository for Opportunity model."""
    
    @staticmethod
    def get_all_opportunities(filters=None):
        """
        Get all opportunities with optional filtering.
        
        Args:
            filters (dict): Optional filters to apply
            
        Returns:
            QuerySet: Filtered opportunities
        """
        queryset = Opportunity.objects.all()
        
        if filters:
            if 'make' in filters:
                queryset = queryset.filter(make__icontains=filters['make'])
            if 'model' in filters:
                queryset = queryset.filter(model__icontains=filters['model'])
            if 'year' in filters:
                queryset = queryset.filter(year=filters['year'])
            if 'status' in filters:
                queryset = queryset.filter(status=filters['status'])
            if 'min_score' in filters:
                queryset = queryset.filter(opportunity_score__gte=filters['min_score'])
        
        return queryset
    
    @staticmethod
    def create_opportunity(opportunity_data):
        """
        Create a new opportunity.
        
        Args:
            opportunity_data (dict): Opportunity data
            
        Returns:
            Opportunity: Created opportunity instance
        """
        return Opportunity.objects.create(**opportunity_data)


class UserPreferenceRepository:
    """Repository for UserPreference model."""
    
    @staticmethod
    def get_user_preference(user_id):
        """
        Get preferences for a specific user.
        
        Args:
            user_id (int): User ID
            
        Returns:
            UserPreference: User preference instance or None
        """
        try:
            return UserPreference.objects.get(user_id=user_id)
        except UserPreference.DoesNotExist:
            return None
    
    @staticmethod
    def create_or_update_preference(user_id, preference_data):
        """
        Create or update user preferences.
        
        Args:
            user_id (int): User ID
            preference_data (dict): Preference data
            
        Returns:
            UserPreference: Created or updated user preference instance
        """
        preference, created = UserPreference.objects.get_or_create(user_id=user_id)
        
        for key, value in preference_data.items():
            setattr(preference, key, value)
        
        preference.save()
        return preference
