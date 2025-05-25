# I-fixit API Design

## Overview
This document outlines the API design for the I-fixit car investment tracking system. The API will be used for integration with the future Python microservice for web scraping and data analysis.

## API Architecture
- **RESTful API**: Following REST principles
- **JSON Format**: All requests and responses in JSON format
- **Authentication**: JWT-based authentication
- **Versioning**: API versioning via URL path (e.g., `/api/v1/`)
- **Rate Limiting**: To prevent abuse
- **HTTPS**: All API traffic over HTTPS

## Authentication

### Endpoints

#### `POST /api/v1/auth/login`
Authenticate and receive a JWT token.

**Request:**
```json
{
  "email": "service@example.com",
  "password": "secure_password"
}
```

**Response:**
```json
{
  "status": "success",
  "data": {
    "token": "eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9...",
    "token_type": "Bearer",
    "expires_in": 3600
  }
}
```

#### `POST /api/v1/auth/refresh`
Refresh an existing JWT token.

**Request:**
```json
{
  "token": "eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9..."
}
```

**Response:**
```json
{
  "status": "success",
  "data": {
    "token": "eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9...",
    "token_type": "Bearer",
    "expires_in": 3600
  }
}
```

#### `POST /api/v1/auth/logout`
Invalidate a JWT token.

**Request:**
```json
{
  "token": "eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9..."
}
```

**Response:**
```json
{
  "status": "success",
  "message": "Successfully logged out"
}
```

## Cars API

### Endpoints

#### `GET /api/v1/cars`
Get a list of cars with optional filtering.

**Query Parameters:**
- `phase`: Filter by current phase (bidding, fixing, dealership, sold)
- `make`: Filter by car make
- `model`: Filter by car model
- `year`: Filter by car year
- `page`: Page number for pagination
- `per_page`: Items per page (default: 20)

**Response:**
```json
{
  "status": "success",
  "data": {
    "cars": [
      {
        "id": 1,
        "make": "Toyota",
        "model": "Corolla",
        "year": 2018,
        "current_phase": "dealership",
        "purchase_price": 90000,
        "total_investment": 150000,
        "selling_price": null,
        "profit_loss": null,
        "created_at": "2023-01-15T10:30:00Z",
        "updated_at": "2023-03-20T14:45:00Z"
      },
      // More cars...
    ],
    "pagination": {
      "total": 45,
      "per_page": 20,
      "current_page": 1,
      "last_page": 3,
      "next_page_url": "/api/v1/cars?page=2",
      "prev_page_url": null
    }
  }
}
```

#### `GET /api/v1/cars/{id}`
Get detailed information about a specific car.

**Response:**
```json
{
  "status": "success",
  "data": {
    "car": {
      "id": 1,
      "make": "Toyota",
      "model": "Corolla",
      "year": 2018,
      "vin": "ABC123XYZ456",
      "registration_number": "CA123456",
      "color": "Silver",
      "body_type": "Sedan",
      "engine_size": "1.8L",
      "fuel_type": "Petrol",
      "transmission": "Automatic",
      "mileage": 85000,
      "features": {
        "sunroof": true,
        "leather_seats": true,
        "navigation": false,
        "custom_rims": false
      },
      "purchase_date": "2023-01-15",
      "purchase_price": 90000,
      "auction_house": "ABC Auctions",
      "auction_lot_number": "LOT123",
      "damage_description": "Front-end collision with moderate damage to bumper, radiator, and hood. Minor damage to left headlight assembly.",
      "damage_severity": "moderate",
      "operational_status": "non-running",
      "current_phase": "dealership",
      "repair_start_date": "2023-02-10",
      "repair_end_date": "2023-03-20",
      "dealership_date": "2023-03-20",
      "sold_date": null,
      "notes": "Car has been at the dealership for 45 days. Several interested buyers but no firm offers yet.",
      "created_at": "2023-01-15T10:30:00Z",
      "updated_at": "2023-03-20T14:45:00Z",
      "parts": [
        {
          "id": 1,
          "name": "Front Bumper",
          "supplier": "ABC Parts",
          "purchase_date": "2023-02-12",
          "total_price": 8500
        },
        // More parts...
      ],
      "labor": [
        {
          "id": 1,
          "service_type": "Panel Beating",
          "provider_name": "XYZ Auto Body",
          "total_cost": 12000
        },
        // More labor entries...
      ],
      "painting": [
        {
          "id": 1,
          "painting_type": "full",
          "total_cost": 5000
        }
      ],
      "sales": {
        "listing_date": "2023-03-20",
        "asking_price": 185000,
        "platform": "Dealership",
        "selling_price": null,
        "sale_date": null
      },
      "financial_summary": {
        "purchase_price": 90000,
        "parts_cost": 35000,
        "labor_cost": 20000,
        "painting_cost": 5000,
        "total_investment": 150000,
        "selling_price": null,
        "profit_loss": null,
        "roi_percentage": null
      },
      "images": [
        {
          "id": 1,
          "image_path": "/storage/cars/1/before_1.jpg",
          "image_type": "before_repair"
        },
        // More images...
      ]
    }
  }
}
```

#### `GET /api/v1/cars/completed`
Get a list of completed car investments (sold cars).

**Query Parameters:**
- `make`: Filter by car make
- `model`: Filter by car model
- `year`: Filter by car year
- `min_profit`: Filter by minimum profit
- `max_profit`: Filter by maximum profit
- `page`: Page number for pagination
- `per_page`: Items per page (default: 20)

**Response:**
```json
{
  "status": "success",
  "data": {
    "cars": [
      {
        "id": 3,
        "make": "BMW",
        "model": "3 Series",
        "year": 2017,
        "purchase_price": 120000,
        "total_investment": 200000,
        "selling_price": 245000,
        "profit_loss": 45000,
        "roi_percentage": 22.5,
        "days_to_complete": 95,
        "sold_date": "2023-02-15T09:20:00Z"
      },
      // More cars...
    ],
    "pagination": {
      "total": 12,
      "per_page": 20,
      "current_page": 1,
      "last_page": 1,
      "next_page_url": null,
      "prev_page_url": null
    }
  }
}
```

## Opportunities API

### Endpoints

#### `POST /api/v1/opportunities`
Create a new opportunity identified by the Python microservice.

**Request:**
```json
{
  "source": "SMD",
  "listing_url": "https://www.smd.co.za/vehicle/2019-toyota-corolla-1-8-xr/BDN488K",
  "make": "Toyota",
  "model": "Corolla",
  "year": 2019,
  "auction_end_date": "2023-05-10T15:00:00Z",
  "current_bid": 65000,
  "damage_description": "Rear-end collision with damage to trunk, rear bumper, and tail lights.",
  "image_urls": [
    "https://www.smd.co.za/photo/123456/frontleft/regular/photo.jpg",
    "https://www.smd.co.za/photo/123456/damage/regular/photo.jpg"
  ],
  "estimated_repair_cost": 35000,
  "estimated_market_value": 145000,
  "potential_profit": 45000,
  "opportunity_score": 85
}
```

**Response:**
```json
{
  "status": "success",
  "data": {
    "opportunity": {
      "id": 1,
      "source": "SMD",
      "listing_url": "https://www.smd.co.za/vehicle/2019-toyota-corolla-1-8-xr/BDN488K",
      "make": "Toyota",
      "model": "Corolla",
      "year": 2019,
      "auction_end_date": "2023-05-10T15:00:00Z",
      "current_bid": 65000,
      "damage_description": "Rear-end collision with damage to trunk, rear bumper, and tail lights.",
      "image_urls": [
        "https://www.smd.co.za/photo/123456/frontleft/regular/photo.jpg",
        "https://www.smd.co.za/photo/123456/damage/regular/photo.jpg"
      ],
      "estimated_repair_cost": 35000,
      "estimated_market_value": 145000,
      "potential_profit": 45000,
      "opportunity_score": 85,
      "status": "new",
      "created_at": "2023-05-04T12:30:00Z",
      "updated_at": "2023-05-04T12:30:00Z"
    }
  }
}
```

#### `GET /api/v1/opportunities`
Get a list of opportunities with optional filtering.

**Query Parameters:**
- `status`: Filter by status (new, viewed, interested, bidding, won, lost, expired)
- `min_score`: Filter by minimum opportunity score
- `make`: Filter by car make
- `model`: Filter by car model
- `min_profit`: Filter by minimum potential profit
- `page`: Page number for pagination
- `per_page`: Items per page (default: 20)

**Response:**
```json
{
  "status": "success",
  "data": {
    "opportunities": [
      {
        "id": 1,
        "source": "SMD",
        "make": "Toyota",
        "model": "Corolla",
        "year": 2019,
        "current_bid": 65000,
        "estimated_repair_cost": 35000,
        "estimated_market_value": 145000,
        "potential_profit": 45000,
        "opportunity_score": 85,
        "status": "new",
        "auction_end_date": "2023-05-10T15:00:00Z",
        "created_at": "2023-05-04T12:30:00Z"
      },
      // More opportunities...
    ],
    "pagination": {
      "total": 28,
      "per_page": 20,
      "current_page": 1,
      "last_page": 2,
      "next_page_url": "/api/v1/opportunities?page=2",
      "prev_page_url": null
    }
  }
}
```

#### `GET /api/v1/opportunities/{id}`
Get detailed information about a specific opportunity.

**Response:**
```json
{
  "status": "success",
  "data": {
    "opportunity": {
      "id": 1,
      "source": "SMD",
      "listing_url": "https://www.smd.co.za/vehicle/2019-toyota-corolla-1-8-xr/BDN488K",
      "make": "Toyota",
      "model": "Corolla",
      "year": 2019,
      "auction_end_date": "2023-05-10T15:00:00Z",
      "current_bid": 65000,
      "damage_description": "Rear-end collision with damage to trunk, rear bumper, and tail lights.",
      "image_urls": [
        "https://www.smd.co.za/photo/123456/frontleft/regular/photo.jpg",
        "https://www.smd.co.za/photo/123456/damage/regular/photo.jpg"
      ],
      "estimated_repair_cost": 35000,
      "estimated_market_value": 145000,
      "potential_profit": 45000,
      "opportunity_score": 85,
      "status": "new",
      "created_at": "2023-05-04T12:30:00Z",
      "updated_at": "2023-05-04T12:30:00Z",
      "similar_completed_cars": [
        {
          "id": 5,
          "make": "Toyota",
          "model": "Corolla",
          "year": 2018,
          "purchase_price": 70000,
          "total_investment": 110000,
          "selling_price": 160000,
          "profit_loss": 50000,
          "roi_percentage": 45.45
        },
        // More similar cars...
      ]
    }
  }
}
```

#### `PUT /api/v1/opportunities/{id}`
Update the status of an opportunity.

**Request:**
```json
{
  "status": "interested"
}
```

**Response:**
```json
{
  "status": "success",
  "data": {
    "opportunity": {
      "id": 1,
      "status": "interested",
      "updated_at": "2023-05-04T14:45:00Z"
    }
  }
}
```

#### `GET /api/v1/opportunities/stats`
Get statistics about opportunities.

**Response:**
```json
{
  "status": "success",
  "data": {
    "total_opportunities": 28,
    "by_status": {
      "new": 15,
      "viewed": 5,
      "interested": 3,
      "bidding": 2,
      "won": 1,
      "lost": 1,
      "expired": 1
    },
    "by_make": {
      "Toyota": 8,
      "Honda": 6,
      "BMW": 4,
      "VW": 5,
      "Ford": 3,
      "Other": 2
    },
    "average_score": 72,
    "average_potential_profit": 38500
  }
}
```

## User Preferences API

### Endpoints

#### `GET /api/v1/preferences/{user_id}`
Get preferences for a specific user.

**Response:**
```json
{
  "status": "success",
  "data": {
    "preferences": {
      "id": 1,
      "user_id": 1,
      "preferred_makes": ["Toyota", "Honda", "VW"],
      "preferred_models": ["Corolla", "Civic", "Golf"],
      "min_year": 2015,
      "max_year": 2022,
      "min_profit": 30000,
      "max_investment": 200000,
      "notification_email": true,
      "notification_sms": false,
      "notification_app": true,
      "created_at": "2023-01-01T00:00:00Z",
      "updated_at": "2023-04-15T10:20:00Z"
    }
  }
}
```

#### `PUT /api/v1/preferences/{user_id}`
Update preferences for a specific user.

**Request:**
```json
{
  "preferred_makes": ["Toyota", "Honda", "VW", "BMW"],
  "preferred_models": ["Corolla", "Civic", "Golf", "3 Series"],
  "min_year": 2016,
  "max_year": 2023,
  "min_profit": 35000,
  "max_investment": 250000,
  "notification_email": true,
  "notification_sms": true,
  "notification_app": true
}
```

**Response:**
```json
{
  "status": "success",
  "data": {
    "preferences": {
      "id": 1,
      "user_id": 1,
      "preferred_makes": ["Toyota", "Honda", "VW", "BMW"],
      "preferred_models": ["Corolla", "Civic", "Golf", "3 Series"],
      "min_year": 2016,
      "max_year": 2023,
      "min_profit": 35000,
      "max_investment": 250000,
      "notification_email": true,
      "notification_sms": true,
      "notification_app": true,
      "updated_at": "2023-05-04T15:30:00Z"
    }
  }
}
```

## Notifications API

### Endpoints

#### `POST /api/v1/notifications`
Create a new notification.

**Request:**
```json
{
  "user_id": 1,
  "type": "opportunity",
  "title": "New High-Scoring Opportunity",
  "message": "A Toyota Corolla (2019) with a score of 85 is available on SMD.",
  "data": {
    "opportunity_id": 1,
    "score": 85,
    "make": "Toyota",
    "model": "Corolla",
    "year": 2019
  }
}
```

**Response:**
```json
{
  "status": "success",
  "data": {
    "notification": {
      "id": 1,
      "user_id": 1,
      "type": "opportunity",
      "title": "New High-Scoring Opportunity",
      "message": "A Toyota Corolla (2019) with a score of 85 is available on SMD.",
      "data": {
        "opportunity_id": 1,
        "score": 85,
        "make": "Toyota",
        "model": "Corolla",
        "year": 2019
      },
      "read_at": null,
      "created_at": "2023-05-04T15:45:00Z"
    }
  }
}
```

#### `GET /api/v1/notifications/unread`
Get unread notifications for the authenticated user.

**Response:**
```json
{
  "status": "success",
  "data": {
    "notifications": [
      {
        "id": 1,
        "type": "opportunity",
        "title": "New High-Scoring Opportunity",
        "message": "A Toyota Corolla (2019) with a score of 85 is available on SMD.",
        "data": {
          "opportunity_id": 1,
          "score": 85,
          "make": "Toyota",
          "model": "Corolla",
          "year": 2019
        },
        "created_at": "2023-05-04T15:45:00Z"
      },
      // More notifications...
    ],
    "count": 3
  }
}
```

#### `PUT /api/v1/notifications/{id}/read`
Mark a notification as read.

**Response:**
```json
{
  "status": "success",
  "data": {
    "notification": {
      "id": 1,
      "read_at": "2023-05-04T16:00:00Z"
    }
  }
}
```

## Analytics API

### Endpoints

#### `GET /api/v1/analytics/profitability`
Get profitability analytics.

**Query Parameters:**
- `start_date`: Start date for analysis (default: 1 year ago)
- `end_date`: End date for analysis (default: today)
- `make`: Filter by car make
- `model`: Filter by car model

**Response:**
```json
{
  "status": "success",
  "data": {
    "total_cars_sold": 17,
    "total_investment": 1734000,
    "total_revenue": 2040000,
    "total_profit": 306000,
    "average_roi": 17.65,
    "by_make": [
      {
        "make": "Toyota",
        "count": 5,
        "avg_purchase_price": 95000,
        "avg_repair_cost": 45000,
        "avg_selling_price": 165000,
        "avg_profit": 25000,
        "avg_roi": 17.86
      },
      // More makes...
    ],
    "by_model": [
      {
        "make": "Toyota",
        "model": "Corolla",
        "count": 3,
        "avg_purchase_price": 92000,
        "avg_repair_cost": 43000,
        "avg_selling_price": 162000,
        "avg_profit": 27000,
        "avg_roi": 20.00
      },
      // More models...
    ],
    "monthly_trend": [
      {
        "month": "2023-01",
        "cars_sold": 2,
        "total_profit": 48000,
        "avg_roi": 16.55
      },
      // More months...
    ]
  }
}
```

#### `GET /api/v1/analytics/repair-costs`
Get repair cost analytics.

**Query Parameters:**
- `start_date`: Start date for analysis (default: 1 year ago)
- `end_date`: End date for analysis (default: today)
- `make`: Filter by car make
- `model`: Filter by car model

**Response:**
```json
{
  "status": "success",
  "data": {
    "total_cars": 24,
    "average_repair_cost": 49000,
    "by_damage_severity": [
      {
        "severity": "light",
        "count": 8,
        "avg_repair_cost": 32000
      },
      {
        "severity": "moderate",
        "count": 12,
        "avg_repair_cost": 48000
      },
      {
        "severity": "severe",
        "count": 4,
        "avg_repair_cost": 85000
      }
    ],
    "cost_breakdown": {
      "parts": 58,
      "labor": 32,
      "painting": 10
    },
    "common_parts": [
      {
        "name": "Bumper",
        "count": 15,
        "avg_cost": 7500
      },
      {
        "name": "Hood",
        "count": 10,
        "avg_cost": 6800
      },
      // More parts...
    ]
  }
}
```

## Error Handling

All API endpoints will return appropriate HTTP status codes and error messages in a consistent format:

### 400 Bad Request
```json
{
  "status": "error",
  "message": "Invalid input data",
  "errors": {
    "make": ["The make field is required."],
    "year": ["The year must be a valid year."]
  }
}
```

### 401 Unauthorized
```json
{
  "status": "error",
  "message": "Unauthenticated"
}
```

### 403 Forbidden
```json
{
  "status": "error",
  "message": "You do not have permission to access this resource"
}
```

### 404 Not Found
```json
{
  "status": "error",
  "message": "Resource not found"
}
```

### 422 Unprocessable Entity
```json
{
  "status": "error",
  "message": "The given data was invalid",
  "errors": {
    "selling_price": ["The selling price must be greater than the total investment."]
  }
}
```

### 500 Internal Server Error
```json
{
  "status": "error",
  "message": "An unexpected error occurred"
}
```

## Rate Limiting
The API will implement rate limiting to prevent abuse. Rate limits will be communicated via HTTP headers:

```
X-RateLimit-Limit: 60
X-RateLimit-Remaining: 59
X-RateLimit-Reset: 1620000000
```

When the rate limit is exceeded, the API will return a 429 Too Many Requests response:

```json
{
  "status": "error",
  "message": "Too many requests",
  "retry_after": 60
}
```

## Pagination
List endpoints will support pagination with consistent parameters and response format:

**Query Parameters:**
- `page`: Page number (default: 1)
- `per_page`: Items per page (default: 20, max: 100)

**Response Headers:**
```
X-Total-Count: 45
X-Total-Pages: 3
X-Current-Page: 1
X-Next-Page: 2
X-Prev-Page: null
```

## Versioning
The API will be versioned via the URL path (e.g., `/api/v1/`). When breaking changes are introduced, a new version will be created (e.g., `/api/v2/`).

## Documentation
The API will be documented using OpenAPI/Swagger specifications, providing:
- Endpoint descriptions
- Request/response schemas
- Authentication requirements
- Example requests and responses

## Implementation Notes
- Use Laravel Sanctum for API authentication
- Implement API resources for consistent JSON transformation
- Use form requests for validation
- Implement middleware for rate limiting
- Use Laravel's built-in pagination
- Log all API requests for monitoring and debugging
