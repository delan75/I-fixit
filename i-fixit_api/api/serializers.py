"""
Serializers for the API.
This layer is responsible for data validation and transformation.
"""
from rest_framework import serializers
from django.contrib.auth.models import User
from .models import Car, CarImage, Part, Supplier, Labor, Painting, Sale, Document, DamagedPart, Opportunity, UserPreference


class UserSerializer(serializers.ModelSerializer):
    """Serializer for User model."""

    class Meta:
        model = User
        fields = ['id', 'username', 'email', 'first_name', 'last_name']
        read_only_fields = ['id']


class SupplierSerializer(serializers.ModelSerializer):
    """Serializer for Supplier model."""

    class Meta:
        model = Supplier
        fields = '__all__'
        read_only_fields = ['id', 'created_at', 'updated_at']


class PartSerializer(serializers.ModelSerializer):
    """Serializer for Part model."""

    supplier_name = serializers.SerializerMethodField()

    class Meta:
        model = Part
        fields = '__all__'
        read_only_fields = ['id', 'created_at', 'updated_at']

    def get_supplier_name(self, obj):
        """Get supplier name."""
        return obj.supplier.name if obj.supplier else None


class LaborSerializer(serializers.ModelSerializer):
    """Serializer for Labor model."""

    class Meta:
        model = Labor
        fields = '__all__'
        read_only_fields = ['id', 'created_at', 'updated_at']


class PaintingSerializer(serializers.ModelSerializer):
    """Serializer for Painting model."""

    class Meta:
        model = Painting
        fields = '__all__'
        read_only_fields = ['id', 'created_at', 'updated_at']


class SaleSerializer(serializers.ModelSerializer):
    """Serializer for Sale model."""

    class Meta:
        model = Sale
        fields = '__all__'
        read_only_fields = ['id', 'created_at', 'updated_at']


class DocumentSerializer(serializers.ModelSerializer):
    """Serializer for Document model."""

    class Meta:
        model = Document
        fields = '__all__'
        read_only_fields = ['id', 'created_at', 'updated_at']


class DamagedPartSerializer(serializers.ModelSerializer):
    """Serializer for DamagedPart model."""

    class Meta:
        model = DamagedPart
        fields = '__all__'
        read_only_fields = ['id', 'created_at', 'updated_at']


class CarImageSerializer(serializers.ModelSerializer):
    """Serializer for CarImage model."""

    class Meta:
        model = CarImage
        fields = '__all__'
        read_only_fields = ['id', 'created_at', 'updated_at']


class CarSerializer(serializers.ModelSerializer):
    """Serializer for Car model."""

    user = UserSerializer(read_only=True)

    class Meta:
        model = Car
        fields = '__all__'
        read_only_fields = ['id', 'user', 'created_at', 'updated_at']


class CarDetailSerializer(serializers.ModelSerializer):
    """Detailed serializer for Car model."""

    user = UserSerializer(read_only=True)
    images = CarImageSerializer(many=True, read_only=True)
    parts = PartSerializer(many=True, read_only=True)
    labor = LaborSerializer(many=True, read_only=True)
    painting = PaintingSerializer(many=True, read_only=True)
    damaged_parts = DamagedPartSerializer(many=True, read_only=True)
    documents = DocumentSerializer(many=True, read_only=True)
    sale = SaleSerializer(read_only=True)

    class Meta:
        model = Car
        fields = '__all__'
        read_only_fields = ['id', 'user', 'created_at', 'updated_at']


class CarFinancialSummarySerializer(serializers.Serializer):
    """Serializer for car financial summary."""

    car_id = serializers.IntegerField()
    make = serializers.CharField()
    model = serializers.CharField()
    year = serializers.IntegerField()
    purchase_price = serializers.DecimalField(max_digits=12, decimal_places=2)
    parts_cost = serializers.DecimalField(max_digits=12, decimal_places=2)
    labor_cost = serializers.DecimalField(max_digits=12, decimal_places=2)
    painting_cost = serializers.DecimalField(max_digits=12, decimal_places=2)
    total_investment = serializers.DecimalField(max_digits=12, decimal_places=2)
    selling_price = serializers.DecimalField(max_digits=12, decimal_places=2)
    dealership_commission = serializers.DecimalField(max_digits=12, decimal_places=2)
    profit_loss = serializers.DecimalField(max_digits=12, decimal_places=2)
    roi_percentage = serializers.DecimalField(max_digits=8, decimal_places=2)


class OpportunitySerializer(serializers.ModelSerializer):
    """Serializer for Opportunity model."""

    vehicle_code_display = serializers.CharField(source='get_vehicle_code_display', read_only=True)
    status_display = serializers.CharField(source='get_status_display', read_only=True)

    class Meta:
        model = Opportunity
        fields = [
            'id', 'source', 'listing_url', 'make', 'model', 'year',
            # Auction details
            'auction_end_date', 'current_bid', 'lot_number', 'auction_location',
            # Vehicle details
            'stock_number', 'odometer', 'vehicle_code', 'vehicle_code_display',
            'has_keys', 'vehicle_starts', 'has_battery', 'has_spare_wheel',
            # Assessment details
            'damage_description', 'image_urls', 'estimated_repair_cost',
            'estimated_market_value', 'potential_profit',
            # Opportunity tracking
            'opportunity_score', 'status', 'status_display',
            'created_at', 'updated_at'
        ]
        read_only_fields = ['id', 'created_at', 'updated_at', 'vehicle_code_display', 'status_display']


class UserPreferenceSerializer(serializers.ModelSerializer):
    """Serializer for UserPreference model."""

    class Meta:
        model = UserPreference
        fields = [
            'id', 'user',
            # Basic vehicle preferences
            'preferred_makes', 'preferred_models', 'min_year', 'max_year',
            # Financial preferences
            'min_profit', 'max_investment',
            # Vehicle condition preferences
            'preferred_vehicle_codes', 'require_keys', 'require_starts',
            'require_battery', 'require_spare_wheel',
            # Mileage preferences
            'max_mileage', 'max_annual_mileage',
            # Auction preferences
            'preferred_sources',
            # Notification preferences
            'notification_email', 'notification_sms', 'notification_app',
            'min_score_for_notification',
            # Timestamps
            'created_at', 'updated_at'
        ]
        read_only_fields = ['id', 'user', 'created_at', 'updated_at']
