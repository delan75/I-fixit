"""
Views for the API.
This layer is responsible for handling HTTP requests and responses.
"""
from rest_framework import viewsets, status, permissions
from rest_framework.decorators import action, api_view, permission_classes
from rest_framework.response import Response
from django.shortcuts import get_object_or_404
from drf_yasg.utils import swagger_auto_schema
from drf_yasg import openapi

from .models import Car, CarImage, Part, Supplier, Labor, Painting, Sale, Document, DamagedPart, Opportunity, UserPreference
from .serializers import (
    CarSerializer, CarDetailSerializer, CarImageSerializer, PartSerializer,
    SupplierSerializer, LaborSerializer, PaintingSerializer, SaleSerializer,
    DocumentSerializer, DamagedPartSerializer, OpportunitySerializer,
    UserPreferenceSerializer, CarFinancialSummarySerializer
)
from .services import CarService, OpportunityService, UserPreferenceService
from scrapers.models import AuctionSite, ScrapingJob
from scrapers.services import ScrapingService


class CarViewSet(viewsets.ViewSet):
    """ViewSet for Car model."""

    permission_classes = [permissions.IsAuthenticated]

    @swagger_auto_schema(
        operation_description="Get a list of cars with optional filtering",
        manual_parameters=[
            openapi.Parameter('make', openapi.IN_QUERY, description="Filter by make", type=openapi.TYPE_STRING),
            openapi.Parameter('model', openapi.IN_QUERY, description="Filter by model", type=openapi.TYPE_STRING),
            openapi.Parameter('year', openapi.IN_QUERY, description="Filter by year", type=openapi.TYPE_INTEGER),
            openapi.Parameter('current_phase', openapi.IN_QUERY, description="Filter by current phase", type=openapi.TYPE_STRING),
        ],
        responses={200: CarSerializer(many=True)}
    )
    def list(self, request):
        """
        Get a list of cars with optional filtering.
        """
        filters = {}

        # Extract filters from query parameters
        if 'make' in request.query_params:
            filters['make'] = request.query_params.get('make')
        if 'model' in request.query_params:
            filters['model'] = request.query_params.get('model')
        if 'year' in request.query_params:
            filters['year'] = request.query_params.get('year')
        if 'current_phase' in request.query_params:
            filters['current_phase'] = request.query_params.get('current_phase')

        # Add user filter for non-admin users
        if not request.user.is_staff:
            filters['user_id'] = request.user.id

        cars = CarService.get_all_cars(filters)
        serializer = CarSerializer(cars, many=True)

        return Response({
            'status': 'success',
            'data': serializer.data
        })

    @swagger_auto_schema(
        operation_description="Get detailed information for a specific car",
        responses={
            200: CarDetailSerializer(),
            404: "Car not found"
        }
    )
    def retrieve(self, request, pk=None):
        """
        Get detailed information for a specific car.
        """
        car = CarService.get_car_by_id(pk)

        if not car:
            return Response({
                'status': 'error',
                'message': 'Car not found'
            }, status=status.HTTP_404_NOT_FOUND)

        # Check if user has permission to view this car
        if not request.user.is_staff and car.user_id != request.user.id:
            return Response({
                'status': 'error',
                'message': 'You do not have permission to view this car'
            }, status=status.HTTP_403_FORBIDDEN)

        serializer = CarDetailSerializer(car)

        return Response({
            'status': 'success',
            'data': serializer.data
        })

    @swagger_auto_schema(
        operation_description="Create a new car",
        request_body=CarSerializer,
        responses={
            201: CarSerializer(),
            400: "Invalid data"
        }
    )
    def create(self, request):
        """
        Create a new car.
        """
        serializer = CarSerializer(data=request.data)

        if serializer.is_valid():
            car = CarService.create_car(serializer.validated_data, request.user.id)
            response_serializer = CarSerializer(car)

            return Response({
                'status': 'success',
                'data': response_serializer.data
            }, status=status.HTTP_201_CREATED)

        return Response({
            'status': 'error',
            'message': 'Invalid data',
            'errors': serializer.errors
        }, status=status.HTTP_400_BAD_REQUEST)

    @swagger_auto_schema(
        operation_description="Update a car",
        request_body=CarSerializer,
        responses={
            200: CarSerializer(),
            400: "Invalid data",
            404: "Car not found"
        }
    )
    def update(self, request, pk=None):
        """
        Update a car.
        """
        car = CarService.get_car_by_id(pk)

        if not car:
            return Response({
                'status': 'error',
                'message': 'Car not found'
            }, status=status.HTTP_404_NOT_FOUND)

        # Check if user has permission to update this car
        if not request.user.is_staff and car.user_id != request.user.id:
            return Response({
                'status': 'error',
                'message': 'You do not have permission to update this car'
            }, status=status.HTTP_403_FORBIDDEN)

        serializer = CarSerializer(data=request.data, partial=True)

        if serializer.is_valid():
            updated_car = CarService.update_car(pk, serializer.validated_data)
            response_serializer = CarSerializer(updated_car)

            return Response({
                'status': 'success',
                'data': response_serializer.data
            })

        return Response({
            'status': 'error',
            'message': 'Invalid data',
            'errors': serializer.errors
        }, status=status.HTTP_400_BAD_REQUEST)

    @swagger_auto_schema(
        operation_description="Delete a car",
        responses={
            204: "No content",
            404: "Car not found"
        }
    )
    def destroy(self, request, pk=None):
        """
        Delete a car.
        """
        car = CarService.get_car_by_id(pk)

        if not car:
            return Response({
                'status': 'error',
                'message': 'Car not found'
            }, status=status.HTTP_404_NOT_FOUND)

        # Check if user has permission to delete this car
        if not request.user.is_staff and car.user_id != request.user.id:
            return Response({
                'status': 'error',
                'message': 'You do not have permission to delete this car'
            }, status=status.HTTP_403_FORBIDDEN)

        CarService.delete_car(pk)

        return Response(status=status.HTTP_204_NO_CONTENT)

    @swagger_auto_schema(
        operation_description="Get financial summary for a car",
        responses={
            200: CarFinancialSummarySerializer(),
            404: "Car not found"
        }
    )
    @action(detail=True, methods=['get'])
    def financial_summary(self, request, pk=None):
        """
        Get financial summary for a car.
        """
        car = CarService.get_car_by_id(pk)

        if not car:
            return Response({
                'status': 'error',
                'message': 'Car not found'
            }, status=status.HTTP_404_NOT_FOUND)

        # Check if user has permission to view this car
        if not request.user.is_staff and car.user_id != request.user.id:
            return Response({
                'status': 'error',
                'message': 'You do not have permission to view this car'
            }, status=status.HTTP_403_FORBIDDEN)

        summary = CarService.get_car_financial_summary(pk)
        serializer = CarFinancialSummarySerializer(summary)

        return Response({
            'status': 'success',
            'data': serializer.data
        })

    @swagger_auto_schema(
        operation_description="Get parts for a car",
        responses={
            200: PartSerializer(many=True),
            404: "Car not found"
        }
    )
    @action(detail=True, methods=['get'])
    def parts(self, request, pk=None):
        """
        Get parts for a car.
        """
        car = CarService.get_car_by_id(pk)

        if not car:
            return Response({
                'status': 'error',
                'message': 'Car not found'
            }, status=status.HTTP_404_NOT_FOUND)

        # Check if user has permission to view this car
        if not request.user.is_staff and car.user_id != request.user.id:
            return Response({
                'status': 'error',
                'message': 'You do not have permission to view this car'
            }, status=status.HTTP_403_FORBIDDEN)

        parts = CarService.get_parts_by_car_id(pk)
        serializer = PartSerializer(parts, many=True)

        return Response({
            'status': 'success',
            'data': serializer.data
        })


class OpportunityViewSet(viewsets.ViewSet):
    """ViewSet for Opportunity model."""

    permission_classes = [permissions.IsAuthenticated]

    @swagger_auto_schema(
        operation_description="Get a list of opportunities with optional filtering",
        manual_parameters=[
            openapi.Parameter('make', openapi.IN_QUERY, description="Filter by make", type=openapi.TYPE_STRING),
            openapi.Parameter('model', openapi.IN_QUERY, description="Filter by model", type=openapi.TYPE_STRING),
            openapi.Parameter('year', openapi.IN_QUERY, description="Filter by year", type=openapi.TYPE_INTEGER),
            openapi.Parameter('status', openapi.IN_QUERY, description="Filter by status", type=openapi.TYPE_STRING),
            openapi.Parameter('min_score', openapi.IN_QUERY, description="Filter by minimum score", type=openapi.TYPE_INTEGER),
        ],
        responses={200: OpportunitySerializer(many=True)}
    )
    def list(self, request):
        """
        Get a list of opportunities with optional filtering.
        """
        filters = {}

        # Extract filters from query parameters
        if 'make' in request.query_params:
            filters['make'] = request.query_params.get('make')
        if 'model' in request.query_params:
            filters['model'] = request.query_params.get('model')
        if 'year' in request.query_params:
            filters['year'] = request.query_params.get('year')
        if 'status' in request.query_params:
            filters['status'] = request.query_params.get('status')
        if 'min_score' in request.query_params:
            filters['min_score'] = request.query_params.get('min_score')

        opportunities = OpportunityService.get_all_opportunities(filters)
        serializer = OpportunitySerializer(opportunities, many=True)

        return Response({
            'status': 'success',
            'data': serializer.data
        })

    @swagger_auto_schema(
        operation_description="Create a new opportunity",
        request_body=OpportunitySerializer,
        responses={
            201: OpportunitySerializer(),
            400: "Invalid data"
        }
    )
    def create(self, request):
        """
        Create a new opportunity.
        """
        serializer = OpportunitySerializer(data=request.data)

        if serializer.is_valid():
            opportunity = OpportunityService.create_opportunity(serializer.validated_data)
            response_serializer = OpportunitySerializer(opportunity)

            return Response({
                'status': 'success',
                'data': response_serializer.data
            }, status=status.HTTP_201_CREATED)

        return Response({
            'status': 'error',
            'message': 'Invalid data',
            'errors': serializer.errors
        }, status=status.HTTP_400_BAD_REQUEST)


class UserPreferenceViewSet(viewsets.ViewSet):
    """ViewSet for UserPreference model."""

    permission_classes = [permissions.IsAuthenticated]

    @swagger_auto_schema(
        operation_description="Get user preferences",
        responses={200: UserPreferenceSerializer()}
    )
    def list(self, request):
        """
        Get user preferences.
        """
        preference = UserPreferenceService.get_user_preference(request.user.id)

        if not preference:
            # Return empty preference if not found
            return Response({
                'status': 'success',
                'data': {}
            })

        serializer = UserPreferenceSerializer(preference)

        return Response({
            'status': 'success',
            'data': serializer.data
        })

    @swagger_auto_schema(
        operation_description="Update user preferences",
        request_body=UserPreferenceSerializer,
        responses={
            200: UserPreferenceSerializer(),
            400: "Invalid data"
        }
    )
    def create(self, request):
        """
        Create or update user preferences.
        """
        serializer = UserPreferenceSerializer(data=request.data)

        if serializer.is_valid():
            preference = UserPreferenceService.create_or_update_preference(
                request.user.id, serializer.validated_data
            )
            response_serializer = UserPreferenceSerializer(preference)

            return Response({
                'status': 'success',
                'data': response_serializer.data
            })

        return Response({
            'status': 'error',
            'message': 'Invalid data',
            'errors': serializer.errors
        }, status=status.HTTP_400_BAD_REQUEST)

    @swagger_auto_schema(
        operation_description="Get matching opportunities based on user preferences",
        responses={200: OpportunitySerializer(many=True)}
    )
    @action(detail=False, methods=['get'])
    def matching_opportunities(self, request):
        """
        Get matching opportunities based on user preferences.
        """
        opportunities = UserPreferenceService.match_opportunities_to_preferences(request.user.id)
        serializer = OpportunitySerializer(opportunities, many=True)

        return Response({
            'status': 'success',
            'data': serializer.data
        })


@swagger_auto_schema(
    method='post',
    operation_description="Trigger a scraping job",
    request_body=openapi.Schema(
        type=openapi.TYPE_OBJECT,
        properties={
            'auction_site_id': openapi.Schema(type=openapi.TYPE_INTEGER, description='Auction site ID'),
        },
        required=['auction_site_id']
    ),
    responses={
        201: openapi.Schema(
            type=openapi.TYPE_OBJECT,
            properties={
                'status': openapi.Schema(type=openapi.TYPE_STRING),
                'message': openapi.Schema(type=openapi.TYPE_STRING),
                'job_id': openapi.Schema(type=openapi.TYPE_INTEGER),
            }
        ),
        400: "Invalid data",
        404: "Auction site not found"
    }
)
@api_view(['POST'])
@permission_classes([permissions.IsAuthenticated])
def create_scraping_job(request):
    """
    Create and trigger a scraping job.
    """
    auction_site_id = request.data.get('auction_site_id')

    if not auction_site_id:
        return Response({
            'status': 'error',
            'message': 'auction_site_id is required'
        }, status=status.HTTP_400_BAD_REQUEST)

    # Check if auction site exists
    try:
        auction_site = AuctionSite.objects.get(id=auction_site_id)
    except AuctionSite.DoesNotExist:
        return Response({
            'status': 'error',
            'message': 'Auction site not found'
        }, status=status.HTTP_404_NOT_FOUND)

    # Create scraping job
    job = ScrapingService.create_scraping_job(auction_site_id)

    if not job:
        return Response({
            'status': 'error',
            'message': 'Failed to create scraping job'
        }, status=status.HTTP_500_INTERNAL_SERVER_ERROR)

    # Run scraping job
    success = ScrapingService.run_scraping_job(job.id)

    if success:
        return Response({
            'status': 'success',
            'message': 'Scraping job created and triggered successfully',
            'job_id': job.id
        }, status=status.HTTP_201_CREATED)
    else:
        return Response({
            'status': 'error',
            'message': 'Scraping job created but failed to run',
            'job_id': job.id
        }, status=status.HTTP_500_INTERNAL_SERVER_ERROR)


@swagger_auto_schema(
    method='get',
    operation_description="Get scraping job status",
    manual_parameters=[
        openapi.Parameter('job_id', openapi.IN_QUERY, description="Scraping job ID", type=openapi.TYPE_INTEGER, required=True),
    ],
    responses={
        200: openapi.Schema(
            type=openapi.TYPE_OBJECT,
            properties={
                'status': openapi.Schema(type=openapi.TYPE_STRING),
                'data': openapi.Schema(
                    type=openapi.TYPE_OBJECT,
                    properties={
                        'job_id': openapi.Schema(type=openapi.TYPE_INTEGER),
                        'status': openapi.Schema(type=openapi.TYPE_STRING),
                        'start_time': openapi.Schema(type=openapi.TYPE_STRING, format='date-time'),
                        'end_time': openapi.Schema(type=openapi.TYPE_STRING, format='date-time'),
                        'opportunities_created': openapi.Schema(type=openapi.TYPE_INTEGER),
                        'error_message': openapi.Schema(type=openapi.TYPE_STRING),
                    }
                )
            }
        ),
        404: "Scraping job not found"
    }
)
@api_view(['GET'])
@permission_classes([permissions.IsAuthenticated])
def get_scraping_job_status(request):
    """
    Get the status of a scraping job.
    """
    job_id = request.query_params.get('job_id')

    if not job_id:
        return Response({
            'status': 'error',
            'message': 'job_id is required'
        }, status=status.HTTP_400_BAD_REQUEST)

    # Check if scraping job exists
    try:
        job = ScrapingJob.objects.get(id=job_id)
    except ScrapingJob.DoesNotExist:
        return Response({
            'status': 'error',
            'message': 'Scraping job not found'
        }, status=status.HTTP_404_NOT_FOUND)

    # Return job status
    return Response({
        'status': 'success',
        'data': {
            'job_id': job.id,
            'status': job.status,
            'start_time': job.start_time,
            'end_time': job.end_time,
            'opportunities_created': job.opportunities_created,
            'error_message': job.error_message
        }
    })