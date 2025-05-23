# I-fixit API Documentation

## Overview

The I-fixit API provides programmatic access to car investment data, enabling integration with external systems and the Python microservice for auction data analysis and opportunity identification. This RESTful API uses JWT authentication and returns data in JSON format.

## Base URL

```
https://api.your-domain.com/api/v1
```

## Authentication

The API uses JWT (JSON Web Token) authentication.

### Obtaining a Token

**Endpoint:** `POST /auth/login`

**Request:**
```json
{
  "email": "user@example.com",
  "password": "your_password"
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

### Using the Token

Include the token in the Authorization header for all API requests:

```
Authorization: Bearer eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9...
```

### Refreshing a Token

**Endpoint:** `POST /auth/refresh`

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

### Logging Out

**Endpoint:** `POST /auth/logout`

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

## Response Format

All API responses follow a consistent format:

### Success Response

```json
{
  "status": "success",
  "data": {
    // Resource data here
  },
  "meta": {
    // Pagination, filtering info, etc.
  }
}
```

### Error Response

```json
{
  "status": "error",
  "message": "Error description",
  "errors": {
    // Detailed validation errors (if applicable)
  }
}
```

## HTTP Status Codes

- `200 OK`: Request succeeded
- `201 Created`: Resource created successfully
- `400 Bad Request`: Invalid input data
- `401 Unauthorized`: Authentication required
- `403 Forbidden`: Authenticated but not authorized
- `404 Not Found`: Resource not found
- `422 Unprocessable Entity`: Validation errors
- `500 Internal Server Error`: Server-side error

## Pagination

Paginated endpoints return metadata about the pagination:

```json
{
  "status": "success",
  "data": [...],
  "meta": {
    "current_page": 1,
    "from": 1,
    "last_page": 5,
    "path": "https://api.your-domain.com/api/v1/cars",
    "per_page": 20,
    "to": 20,
    "total": 100
  }
}
```

Use the following query parameters to control pagination:
- `page`: Page number (default: 1)
- `per_page`: Items per page (default: 20, max: 100)

## Filtering

Many endpoints support filtering using query parameters:

```
GET /cars?make=Toyota&year=2020&current_phase=dealership
```

## Endpoints

### Cars

#### List Cars

**Endpoint:** `GET /cars`

**Query Parameters:**
- `make`: Filter by car make
- `model`: Filter by car model
- `year`: Filter by car year
- `current_phase`: Filter by phase (bidding, fixing, dealership, sold)
- `page`: Page number
- `per_page`: Items per page

**Response:**
```json
{
  "status": "success",
  "data": [
    {
      "id": "550e8400-e29b-41d4-a716-446655440000",
      "make": "Toyota",
      "model": "Corolla",
      "year": 2020,
      "vin": "JTDKN3DU0J1742143",
      "registration_number": "ABC 123 GP",
      "color": "Silver",
      "body_type": "Sedan",
      "engine_size": "1.8L",
      "fuel_type": "Petrol",
      "transmission": "Automatic",
      "mileage": 45000,
      "features": ["Sunroof", "Leather seats", "Navigation"],
      "purchase_date": "2023-05-15",
      "purchase_price": 120000,
      "current_phase": "dealership",
      "created_at": "2023-05-15T10:30:00Z",
      "updated_at": "2023-06-20T14:15:00Z"
    },
    // More cars...
  ],
  "meta": {
    "current_page": 1,
    "from": 1,
    "last_page": 5,
    "path": "https://api.your-domain.com/api/v1/cars",
    "per_page": 20,
    "to": 20,
    "total": 100
  }
}
```

#### Get Car Details

**Endpoint:** `GET /cars/{id}`

**Response:**
```json
{
  "status": "success",
  "data": {
    "id": "550e8400-e29b-41d4-a716-446655440000",
    "make": "Toyota",
    "model": "Corolla",
    "year": 2020,
    "vin": "JTDKN3DU0J1742143",
    "registration_number": "ABC 123 GP",
    "color": "Silver",
    "body_type": "Sedan",
    "engine_size": "1.8L",
    "fuel_type": "Petrol",
    "transmission": "Automatic",
    "mileage": 45000,
    "features": ["Sunroof", "Leather seats", "Navigation"],
    "purchase_date": "2023-05-15",
    "purchase_price": 120000,
    "auction_house": "Auto Auctions",
    "auction_lot_number": "LOT123",
    "damage_description": "Front bumper damage, minor scratches",
    "damage_severity": "light",
    "operational_status": "running",
    "current_phase": "dealership",
    "repair_start_date": "2023-05-20",
    "repair_end_date": "2023-06-10",
    "dealership_date": "2023-06-15",
    "sold_date": null,
    "transportation_cost": 2000,
    "registration_papers_cost": 1500,
    "number_plates_cost": 800,
    "dealership_discount": 0,
    "other_costs": 1200,
    "other_costs_description": "Cleaning and inspection",
    "estimated_repair_cost": 15000,
    "estimated_market_value": 180000,
    "notes": "Good condition overall, minor repairs needed",
    "created_at": "2023-05-15T10:30:00Z",
    "updated_at": "2023-06-20T14:15:00Z"
  }
}
```

#### Create Car

**Endpoint:** `POST /cars`

**Request:**
```json
{
  "make": "Toyota",
  "model": "Corolla",
  "year": 2020,
  "vin": "JTDKN3DU0J1742143",
  "registration_number": "ABC 123 GP",
  "color": "Silver",
  "body_type": "Sedan",
  "engine_size": "1.8L",
  "fuel_type": "Petrol",
  "transmission": "Automatic",
  "mileage": 45000,
  "features": ["Sunroof", "Leather seats", "Navigation"],
  "purchase_date": "2023-05-15",
  "purchase_price": 120000,
  "auction_house": "Auto Auctions",
  "auction_lot_number": "LOT123",
  "damage_description": "Front bumper damage, minor scratches",
  "damage_severity": "light",
  "operational_status": "running"
}
```

**Response:**
```json
{
  "status": "success",
  "data": {
    "id": "550e8400-e29b-41d4-a716-446655440000",
    "make": "Toyota",
    "model": "Corolla",
    "year": 2020,
    // Other car details...
    "created_at": "2023-05-15T10:30:00Z",
    "updated_at": "2023-05-15T10:30:00Z"
  }
}
```

#### Update Car

**Endpoint:** `PUT /cars/{id}`

**Request:**
```json
{
  "mileage": 46000,
  "current_phase": "fixing",
  "repair_start_date": "2023-05-20"
}
```

**Response:**
```json
{
  "status": "success",
  "data": {
    "id": "550e8400-e29b-41d4-a716-446655440000",
    "make": "Toyota",
    "model": "Corolla",
    "year": 2020,
    "mileage": 46000,
    "current_phase": "fixing",
    "repair_start_date": "2023-05-20",
    // Other car details...
    "updated_at": "2023-05-20T09:15:00Z"
  }
}
```

#### Delete Car

**Endpoint:** `DELETE /cars/{id}`

**Response:**
```json
{
  "status": "success",
  "message": "Car deleted successfully"
}
```

### Car Parts

#### List Parts for a Car

**Endpoint:** `GET /cars/{car_id}/parts`

**Response:**
```json
{
  "status": "success",
  "data": [
    {
      "id": "550e8400-e29b-41d4-a716-446655440001",
      "car_id": "550e8400-e29b-41d4-a716-446655440000",
      "name": "Front Bumper",
      "description": "OEM Toyota Corolla Front Bumper",
      "condition": "new",
      "quantity": 1,
      "unit_price": 5000,
      "total_price": 5000,
      "purchase_date": "2023-05-25",
      "installation_date": "2023-06-02",
      "supplier_id": "550e8400-e29b-41d4-a716-446655440002",
      "supplier_name": "Toyota Parts Center",
      "created_at": "2023-05-25T11:20:00Z",
      "updated_at": "2023-06-02T14:30:00Z"
    },
    // More parts...
  ],
  "meta": {
    // Pagination metadata
  }
}
```

### Financial Summary

#### Get Car Financial Summary

**Endpoint:** `GET /cars/{car_id}/financial-summary`

**Response:**
```json
{
  "status": "success",
  "data": {
    "car_id": "550e8400-e29b-41d4-a716-446655440000",
    "purchase_price": 120000,
    "parts_cost": 25000,
    "labor_cost": 8000,
    "painting_cost": 12000,
    "transportation_cost": 2000,
    "registration_papers_cost": 1500,
    "number_plates_cost": 800,
    "other_costs": 1200,
    "total_investment": 170500,
    "estimated_market_value": 220000,
    "projected_profit": 49500,
    "projected_roi_percentage": 29.03,
    "actual_selling_price": null,
    "actual_profit": null,
    "actual_roi_percentage": null
  }
}
```

### Opportunities

#### List Opportunities

**Endpoint:** `GET /opportunities`

**Query Parameters:**
- `status`: Filter by status (new, reviewing, approved, rejected)
- `source`: Filter by source
- `page`: Page number
- `per_page`: Items per page

**Response:**
```json
{
  "status": "success",
  "data": [
    {
      "id": "550e8400-e29b-41d4-a716-446655440003",
      "make": "BMW",
      "model": "3 Series",
      "year": 2019,
      "auction_house": "Premium Auto Auctions",
      "auction_date": "2023-07-15",
      "lot_number": "LOT456",
      "estimated_purchase_price": 150000,
      "estimated_repair_cost": 30000,
      "estimated_market_value": 250000,
      "projected_profit": 70000,
      "projected_roi_percentage": 38.89,
      "opportunity_score": 85,
      "status": "new",
      "source": "web_scraper",
      "notes": "Good opportunity with minor damage",
      "created_at": "2023-07-10T08:45:00Z",
      "updated_at": "2023-07-10T08:45:00Z"
    },
    // More opportunities...
  ],
  "meta": {
    // Pagination metadata
  }
}
```

### Notifications

#### List Notifications

**Endpoint:** `GET /notifications`

**Query Parameters:**
- `read`: Filter by read status (true/false)
- `page`: Page number
- `per_page`: Items per page

**Response:**
```json
{
  "status": "success",
  "data": [
    {
      "id": "550e8400-e29b-41d4-a716-446655440004",
      "type": "car_phase_changed",
      "notifiable_type": "App\\Models\\User",
      "notifiable_id": "550e8400-e29b-41d4-a716-446655440005",
      "data": {
        "car_id": "550e8400-e29b-41d4-a716-446655440000",
        "make": "Toyota",
        "model": "Corolla",
        "old_phase": "fixing",
        "new_phase": "dealership",
        "message": "Car has moved to dealership phase"
      },
      "read_at": null,
      "created_at": "2023-06-15T10:00:00Z",
      "updated_at": "2023-06-15T10:00:00Z"
    },
    // More notifications...
  ],
  "meta": {
    // Pagination metadata
  }
}
```

## Rate Limiting

The API implements rate limiting to prevent abuse. Current limits are:
- 60 requests per minute for authenticated users
- 10 requests per minute for unauthenticated requests

When rate limited, the API will return a 429 Too Many Requests response with a Retry-After header indicating when you can resume making requests.

## Error Handling

The API uses standard HTTP status codes and returns detailed error messages to help with debugging.

Example error response:

```json
{
  "status": "error",
  "message": "Validation failed",
  "errors": {
    "make": ["The make field is required."],
    "year": ["The year must be a valid year between 1900 and 2023."]
  }
}
```

## Versioning

The API is versioned through the URL path (e.g., `/api/v1/`). When breaking changes are introduced, a new version will be released (e.g., `/api/v2/`).

## Support

For API support, contact the I-fixit development team at api-support@your-domain.com.
