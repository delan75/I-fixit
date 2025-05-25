from django.db import models
from django.contrib.auth.models import User
from django.utils.translation import gettext_lazy as _


class Car(models.Model):
    """Model representing a car in the system."""

    class CurrentPhase(models.TextChoices):
        BIDDING = 'bidding', _('Bidding')
        FIXING = 'fixing', _('Fixing')
        DEALERSHIP = 'dealership', _('Dealership')
        SOLD = 'sold', _('Sold')

    class DamageSeverity(models.TextChoices):
        LIGHT = 'light', _('Light')
        MODERATE = 'moderate', _('Moderate')
        SEVERE = 'severe', _('Severe')

    class OperationalStatus(models.TextChoices):
        RUNNING = 'running', _('Running')
        NON_RUNNING = 'non_running', _('Non-running')

    user = models.ForeignKey(User, on_delete=models.CASCADE, related_name='cars')
    make = models.CharField(max_length=100)
    model = models.CharField(max_length=100)
    year = models.IntegerField()
    vin = models.CharField(max_length=100, blank=True, null=True)
    registration_number = models.CharField(max_length=50, blank=True, null=True)
    color = models.CharField(max_length=50, blank=True, null=True)
    body_type = models.CharField(max_length=50)
    engine_size = models.CharField(max_length=50, blank=True, null=True)
    fuel_type = models.CharField(max_length=50)
    transmission = models.CharField(max_length=50)
    mileage = models.IntegerField()
    features = models.JSONField(blank=True, null=True)
    purchase_date = models.DateField()
    purchase_price = models.DecimalField(max_digits=12, decimal_places=2)
    auction_house = models.CharField(max_length=100, blank=True, null=True)
    auction_lot_number = models.CharField(max_length=50, blank=True, null=True)
    damage_description = models.TextField()
    damage_severity = models.CharField(
        max_length=20,
        choices=DamageSeverity.choices,
        default=DamageSeverity.MODERATE
    )
    operational_status = models.CharField(
        max_length=20,
        choices=OperationalStatus.choices,
        default=OperationalStatus.RUNNING
    )
    current_phase = models.CharField(
        max_length=20,
        choices=CurrentPhase.choices,
        default=CurrentPhase.BIDDING
    )
    repair_start_date = models.DateField(blank=True, null=True)
    repair_end_date = models.DateField(blank=True, null=True)
    dealership_date = models.DateField(blank=True, null=True)
    sale_date = models.DateField(blank=True, null=True)
    created_at = models.DateTimeField(auto_now_add=True)
    updated_at = models.DateTimeField(auto_now=True)

    def __str__(self):
        return f"{self.year} {self.make} {self.model}"


class CarImage(models.Model):
    """Model representing images of a car."""

    class ImageType(models.TextChoices):
        BEFORE_REPAIR = 'before_repair', _('Before Repair')
        DURING_REPAIR = 'during_repair', _('During Repair')
        AFTER_REPAIR = 'after_repair', _('After Repair')
        DAMAGE = 'damage', _('Damage')
        OTHER = 'other', _('Other')

    car = models.ForeignKey(Car, on_delete=models.CASCADE, related_name='images')
    image = models.ImageField(upload_to='car_images/')
    image_type = models.CharField(
        max_length=20,
        choices=ImageType.choices,
        default=ImageType.OTHER
    )
    description = models.CharField(max_length=255, blank=True, null=True)
    created_at = models.DateTimeField(auto_now_add=True)
    updated_at = models.DateTimeField(auto_now=True)

    def __str__(self):
        return f"Image for {self.car} - {self.get_image_type_display()}"


class Supplier(models.Model):
    """Model representing parts suppliers."""
    name = models.CharField(max_length=100)
    contact_person = models.CharField(max_length=100, blank=True, null=True)
    phone = models.CharField(max_length=20, blank=True, null=True)
    email = models.EmailField(blank=True, null=True)
    address = models.TextField(blank=True, null=True)
    website = models.URLField(blank=True, null=True)
    notes = models.TextField(blank=True, null=True)
    created_at = models.DateTimeField(auto_now_add=True)
    updated_at = models.DateTimeField(auto_now=True)

    def __str__(self):
        return self.name


class Part(models.Model):
    """Model representing replacement parts for cars."""

    class Condition(models.TextChoices):
        NEW = 'new', _('New')
        USED = 'used', _('Used')
        REFURBISHED = 'refurbished', _('Refurbished')

    car = models.ForeignKey(Car, on_delete=models.CASCADE, related_name='parts')
    name = models.CharField(max_length=100)
    description = models.TextField(blank=True, null=True)
    condition = models.CharField(
        max_length=20,
        choices=Condition.choices,
        default=Condition.NEW
    )
    quantity = models.IntegerField(default=1)
    unit_price = models.DecimalField(max_digits=12, decimal_places=2)
    total_price = models.DecimalField(max_digits=12, decimal_places=2)
    purchase_date = models.DateField()
    installation_date = models.DateField(blank=True, null=True)
    supplier = models.ForeignKey(Supplier, on_delete=models.SET_NULL, null=True, related_name='parts')
    created_at = models.DateTimeField(auto_now_add=True)
    updated_at = models.DateTimeField(auto_now=True)

    def __str__(self):
        return f"{self.name} for {self.car}"


class Labor(models.Model):
    """Model representing labor costs for car repairs."""
    car = models.ForeignKey(Car, on_delete=models.CASCADE, related_name='labor')
    description = models.CharField(max_length=255)
    hours = models.DecimalField(max_digits=6, decimal_places=2)
    rate_per_hour = models.DecimalField(max_digits=10, decimal_places=2)
    total_cost = models.DecimalField(max_digits=12, decimal_places=2)
    date = models.DateField()
    mechanic_name = models.CharField(max_length=100, blank=True, null=True)
    notes = models.TextField(blank=True, null=True)
    created_at = models.DateTimeField(auto_now_add=True)
    updated_at = models.DateTimeField(auto_now=True)

    def __str__(self):
        return f"Labor for {self.car}: {self.description}"


class Painting(models.Model):
    """Model representing painting costs for cars."""
    car = models.ForeignKey(Car, on_delete=models.CASCADE, related_name='painting')
    description = models.CharField(max_length=255)
    areas_painted = models.TextField()
    paint_type = models.CharField(max_length=100)
    paint_color = models.CharField(max_length=100)
    total_cost = models.DecimalField(max_digits=12, decimal_places=2)
    date = models.DateField()
    painter_name = models.CharField(max_length=100, blank=True, null=True)
    notes = models.TextField(blank=True, null=True)
    created_at = models.DateTimeField(auto_now_add=True)
    updated_at = models.DateTimeField(auto_now=True)

    def __str__(self):
        return f"Painting for {self.car}: {self.description}"


class Sale(models.Model):
    """Model representing car sales information."""
    car = models.OneToOneField(Car, on_delete=models.CASCADE, related_name='sale')
    selling_price = models.DecimalField(max_digits=12, decimal_places=2)
    buyer_name = models.CharField(max_length=100, blank=True, null=True)
    buyer_contact = models.CharField(max_length=100, blank=True, null=True)
    sale_date = models.DateField()
    payment_method = models.CharField(max_length=50, blank=True, null=True)
    dealership_commission = models.DecimalField(max_digits=12, decimal_places=2, default=0)
    notes = models.TextField(blank=True, null=True)
    created_at = models.DateTimeField(auto_now_add=True)
    updated_at = models.DateTimeField(auto_now=True)

    def __str__(self):
        return f"Sale of {self.car} for R{self.selling_price}"


class Document(models.Model):
    """Model representing vehicle documents."""
    car = models.ForeignKey(Car, on_delete=models.CASCADE, related_name='documents')
    document_type = models.CharField(max_length=100)
    file = models.FileField(upload_to='car_documents/')
    description = models.CharField(max_length=255, blank=True, null=True)
    upload_date = models.DateField()
    created_at = models.DateTimeField(auto_now_add=True)
    updated_at = models.DateTimeField(auto_now=True)

    def __str__(self):
        return f"{self.document_type} for {self.car}"


class DamagedPart(models.Model):
    """Model representing damaged parts identified during assessment."""
    car = models.ForeignKey(Car, on_delete=models.CASCADE, related_name='damaged_parts')
    part_name = models.CharField(max_length=100)
    part_location = models.CharField(max_length=100)
    damage_description = models.TextField()
    estimated_repair_cost = models.DecimalField(max_digits=12, decimal_places=2)
    needs_replacement = models.BooleanField(default=False)
    image = models.ImageField(upload_to='damaged_parts/', blank=True, null=True)
    is_repaired = models.BooleanField(default=False)
    created_at = models.DateTimeField(auto_now_add=True)
    updated_at = models.DateTimeField(auto_now=True)

    def __str__(self):
        return f"{self.part_name} damage on {self.car}"


class Opportunity(models.Model):
    """Model representing potential buying opportunities."""

    class Status(models.TextChoices):
        NEW = 'new', _('New')
        VIEWED = 'viewed', _('Viewed')
        INTERESTED = 'interested', _('Interested')
        BIDDING = 'bidding', _('Bidding')
        WON = 'won', _('Won')
        LOST = 'lost', _('Lost')
        EXPIRED = 'expired', _('Expired')

    class VehicleCode(models.TextChoices):
        CODE_1 = '1', _('Code 1 - New Vehicle')
        CODE_2 = '2', _('Code 2 - Used Vehicle')
        CODE_3 = '3', _('Code 3 - Rebuilt Vehicle')
        CODE_4 = '4', _('Code 4 - Permanently Unfit')
        UNKNOWN = '0', _('Unknown')

    source = models.CharField(max_length=100)
    listing_url = models.URLField()
    make = models.CharField(max_length=100)
    model = models.CharField(max_length=100)
    year = models.IntegerField()

    # Auction details
    auction_end_date = models.DateTimeField(blank=True, null=True)
    current_bid = models.DecimalField(max_digits=12, decimal_places=2, blank=True, null=True)
    lot_number = models.CharField(max_length=50, blank=True, null=True)
    auction_location = models.CharField(max_length=100, blank=True, null=True)

    # Vehicle details
    stock_number = models.CharField(max_length=50, blank=True, null=True)
    odometer = models.CharField(max_length=50, blank=True, null=True)
    vehicle_code = models.CharField(
        max_length=1,
        choices=VehicleCode.choices,
        default=VehicleCode.UNKNOWN
    )
    has_keys = models.BooleanField(default=False)
    has_spare_key = models.BooleanField(default=False)
    vehicle_starts = models.BooleanField(default=False)
    has_battery = models.BooleanField(default=False)
    has_spare_wheel = models.BooleanField(default=False)
    color = models.CharField(max_length=50, blank=True, null=True)
    auction_date = models.DateField(blank=True, null=True)

    # Assessment details
    damage_description = models.TextField(blank=True, null=True)
    image_urls = models.JSONField(blank=True, null=True)
    estimated_repair_cost = models.DecimalField(max_digits=12, decimal_places=2, blank=True, null=True)
    estimated_market_value = models.DecimalField(max_digits=12, decimal_places=2, blank=True, null=True)
    potential_profit = models.DecimalField(max_digits=12, decimal_places=2, blank=True, null=True)

    # Opportunity tracking
    opportunity_score = models.IntegerField()
    status = models.CharField(
        max_length=20,
        choices=Status.choices,
        default=Status.NEW
    )
    created_at = models.DateTimeField(auto_now_add=True)
    updated_at = models.DateTimeField(auto_now=True)

    def __str__(self):
        return f"{self.year} {self.make} {self.model} - Score: {self.opportunity_score}"

    class Meta:
        verbose_name_plural = "Opportunities"
        ordering = ['-opportunity_score', '-created_at']


class UserPreference(models.Model):
    """Model representing user preferences for opportunity notifications."""
    user = models.OneToOneField(User, on_delete=models.CASCADE, related_name='preferences')

    # Basic vehicle preferences
    preferred_makes = models.JSONField(blank=True, null=True)
    preferred_models = models.JSONField(blank=True, null=True)
    min_year = models.IntegerField(blank=True, null=True)
    max_year = models.IntegerField(blank=True, null=True)

    # Financial preferences
    min_profit = models.DecimalField(max_digits=12, decimal_places=2, blank=True, null=True)
    max_investment = models.DecimalField(max_digits=12, decimal_places=2, blank=True, null=True)

    # Vehicle condition preferences
    preferred_vehicle_codes = models.JSONField(blank=True, null=True,
                                              help_text="List of preferred vehicle codes (e.g., ['1', '2'])")
    require_keys = models.BooleanField(default=False,
                                      help_text="Only show vehicles that have keys")
    require_spare_key = models.BooleanField(default=False,
                                          help_text="Only show vehicles that have a spare key")
    require_starts = models.BooleanField(default=False,
                                        help_text="Only show vehicles that start")
    require_battery = models.BooleanField(default=False,
                                         help_text="Only show vehicles that have a battery")
    require_spare_wheel = models.BooleanField(default=False,
                                             help_text="Only show vehicles that have a spare wheel")

    # Mileage preferences
    max_mileage = models.IntegerField(blank=True, null=True,
                                     help_text="Maximum odometer reading in kilometers")
    max_annual_mileage = models.IntegerField(blank=True, null=True,
                                            help_text="Maximum annual mileage in kilometers")

    # Auction preferences
    preferred_sources = models.JSONField(blank=True, null=True,
                                        help_text="List of preferred auction sources")

    # Notification preferences
    notification_email = models.BooleanField(default=True)
    notification_sms = models.BooleanField(default=False)
    notification_app = models.BooleanField(default=True)
    min_score_for_notification = models.IntegerField(default=70,
                                                    help_text="Minimum opportunity score to trigger notification")

    # Timestamps
    created_at = models.DateTimeField(auto_now_add=True)
    updated_at = models.DateTimeField(auto_now=True)

    def __str__(self):
        return f"Preferences for {self.user.username}"
