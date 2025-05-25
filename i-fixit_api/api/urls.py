"""
URL configuration for the API.
"""
from django.urls import path, include
from rest_framework.routers import DefaultRouter
from rest_framework_simplejwt.views import TokenObtainPairView, TokenRefreshView, TokenVerifyView

from .views import (
    CarViewSet, OpportunityViewSet, UserPreferenceViewSet,
    create_scraping_job, get_scraping_job_status
)

# Create a router and register our viewsets with it
router = DefaultRouter()
router.register(r'cars', CarViewSet, basename='car')
router.register(r'opportunities', OpportunityViewSet, basename='opportunity')
router.register(r'preferences', UserPreferenceViewSet, basename='preference')

# The API URLs are determined automatically by the router
urlpatterns = [
    # JWT authentication
    path('auth/login/', TokenObtainPairView.as_view(), name='token_obtain_pair'),
    path('auth/refresh/', TokenRefreshView.as_view(), name='token_refresh'),
    path('auth/verify/', TokenVerifyView.as_view(), name='token_verify'),

    # Scraping endpoints
    path('scrape/', create_scraping_job, name='create_scraping_job'),
    path('scrape/status/', get_scraping_job_status, name='get_scraping_job_status'),

    # Include the router URLs
    path('', include(router.urls)),
]
