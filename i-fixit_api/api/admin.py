from django.contrib import admin
from .models import Car, CarImage, Part, Supplier, Labor, Painting, Sale, Document, DamagedPart, Opportunity, UserPreference

# Register models
admin.site.register(Car)
admin.site.register(CarImage)
admin.site.register(Part)
admin.site.register(Supplier)
admin.site.register(Labor)
admin.site.register(Painting)
admin.site.register(Sale)
admin.site.register(Document)
admin.site.register(DamagedPart)
admin.site.register(Opportunity)
admin.site.register(UserPreference)
