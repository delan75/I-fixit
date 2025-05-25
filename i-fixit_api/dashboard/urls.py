from django.urls import path
from . import views

app_name = 'dashboard'

urlpatterns = [
    path('', views.index, name='index'),
    path('opportunities/', views.opportunities, name='opportunities'),
    path('opportunities/<int:opportunity_id>/', views.opportunity_detail, name='opportunity_detail'),
    path('opportunities/<int:opportunity_id>/update-status/', views.update_opportunity_status, name='update_opportunity_status'),
    path('scrapers/', views.scrapers, name='scrapers'),
    path('scrapers/<int:site_id>/run/', views.run_scraper, name='run_scraper'),
    path('scrapers/<int:site_id>/run-with-preferences/', views.run_scraper_with_preferences, name='run_scraper_with_preferences'),
    path('login/', views.login_view, name='login'),
    path('logout/', views.logout_view, name='logout'),
]
