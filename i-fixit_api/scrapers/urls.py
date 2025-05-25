"""
URL configuration for the scrapers app.
"""
from django.urls import path
from . import views

app_name = 'scrapers'

urlpatterns = [
    path('jobs/', views.scraping_job_list, name='job_list'),
    path('jobs/<int:job_id>/', views.scraping_job_detail, name='job_detail'),
    path('jobs/<int:job_id>/run/', views.run_scraping_job, name='run_job'),
    path('sites/<int:site_id>/create-job/', views.create_scraping_job, name='create_job'),
    path('sites/<int:site_id>/run-with-preferences/', views.run_scraper_with_preferences, name='run_with_preferences'),
]
