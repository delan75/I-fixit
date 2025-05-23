# I-fixit API Development Guide

## Overview
This guide provides comprehensive instructions for developing the RESTful API for the I-fixit car investment tracking system. The API will serve as the foundation for future integration with a Python microservice for auction data analysis and opportunity identification.

## Project Context
I-fixit is a car investment tracking web application built with Laravel, MySQL, Blade, Livewire, Bootstrap 5, and Alpine.js. The application allows users to track car investments, repairs, and sales to maximize profitability. The API will enable external services to interact with the I-fixit system, particularly a planned Python microservice for auction data analysis.

## Sprint 8: API and Integration
**Duration**: August 25, 2025 - September 7, 2025
**Goal**: Implement a secure, well-documented RESTful API with JWT authentication

### Key Tasks
1. Design RESTful API endpoints (T-060)
2. Implement JWT authentication for API (T-061)
3. Create car data API endpoints (T-062)
4. Implement opportunity API endpoints (T-063)
5. Create user preferences API endpoints (T-064)
6. Implement notification API endpoints (T-065)
7. Create API documentation (T-066)

## API Architecture

### Design Principles
- **RESTful**: Follow REST principles for resource-oriented design
- **JSON**: Use JSON for all request and response payloads
- **Versioned**: Implement API versioning via URL path (e.g., `/api/v1/`)
- **Secure**: Implement JWT authentication and proper authorization
- **Well-documented**: Create comprehensive documentation using OpenAPI/Swagger
- **Consistent**: Maintain consistent naming conventions and response formats
- **Stateless**: Design endpoints to be stateless, with all necessary information in each request

### Base URL Structure
```
https://[domain]/api/v1/[resource]
```

### Authentication
- Use Laravel Sanctum for API token authentication
- Implement JWT (JSON Web Tokens) for stateless authentication
- Include token expiration and refresh mechanisms
- Secure all endpoints with proper middleware

### Response Format
All API responses should follow this consistent format:

#### Success Response
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

#### Error Response
```json
{
  "status": "error",
  "message": "Error description",
  "errors": {
    // Detailed validation errors (if applicable)
  }
}
```

### HTTP Status Codes
- 200: OK - Request succeeded
- 201: Created - Resource created successfully
- 400: Bad Request - Invalid input data
- 401: Unauthorized - Authentication required
- 403: Forbidden - Authenticated but not authorized
- 404: Not Found - Resource not found
- 422: Unprocessable Entity - Validation errors
- 500: Internal Server Error - Server-side error

## Required Endpoints

### Authentication Endpoints
- `POST /api/v1/auth/login`: Authenticate and receive JWT token
- `POST /api/v1/auth/refresh`: Refresh JWT token
- `POST /api/v1/auth/logout`: Invalidate JWT token

### Car Data Endpoints
- `GET /api/v1/cars`: List cars with filtering and pagination
- `GET /api/v1/cars/{id}`: Get detailed car information
- `POST /api/v1/cars`: Create a new car record
- `PUT /api/v1/cars/{id}`: Update car information
- `DELETE /api/v1/cars/{id}`: Delete/archive a car
- `GET /api/v1/cars/{id}/parts`: Get parts for a specific car
- `GET /api/v1/cars/{id}/labor`: Get labor entries for a specific car
- `GET /api/v1/cars/{id}/painting`: Get painting entries for a specific car
- `GET /api/v1/cars/{id}/damaged-parts`: Get damaged parts for a specific car
- `GET /api/v1/cars/{id}/images`: Get images for a specific car
- `GET /api/v1/cars/{id}/financial-summary`: Get financial summary for a specific car

### Opportunity Endpoints
- `POST /api/v1/opportunities`: Create a new opportunity
- `GET /api/v1/opportunities`: List opportunities with filtering and pagination
- `GET /api/v1/opportunities/{id}`: Get detailed opportunity information
- `PUT /api/v1/opportunities/{id}`: Update opportunity information
- `DELETE /api/v1/opportunities/{id}`: Delete an opportunity
- `PUT /api/v1/opportunities/{id}/status`: Update opportunity status

### User Preferences Endpoints
- `GET /api/v1/preferences`: Get current user preferences
- `GET /api/v1/preferences/{user_id}`: Get preferences for a specific user (admin only)
- `PUT /api/v1/preferences`: Update current user preferences
- `PUT /api/v1/preferences/{user_id}`: Update preferences for a specific user (admin only)

### Notification Endpoints
- `GET /api/v1/notifications`: Get notifications for current user
- `POST /api/v1/notifications`: Create a new notification
- `PUT /api/v1/notifications/{id}/read`: Mark notification as read
- `PUT /api/v1/notifications/read-all`: Mark all notifications as read

### Statistics Endpoints
- `GET /api/v1/statistics/investment`: Get investment statistics
- `GET /api/v1/statistics/sales`: Get sales statistics
- `GET /api/v1/statistics/repairs`: Get repair statistics

## Implementation Guidelines

### Setting Up Laravel Sanctum
1. Install Laravel Sanctum:
   ```bash
   composer require laravel/sanctum
   ```

2. Publish Sanctum configuration:
   ```bash
   php artisan vendor:publish --provider="Laravel\Sanctum\SanctumServiceProvider"
   ```

3. Run migrations:
   ```bash
   php artisan migrate
   ```

4. Configure Sanctum in `config/sanctum.php`

### JWT Implementation
1. Install JWT package:
   ```bash
   composer require php-open-source-saver/jwt-auth
   ```

2. Publish JWT configuration:
   ```bash
   php artisan vendor:publish --provider="PHPOpenSourceSaver\JWTAuth\Providers\LaravelServiceProvider"
   ```

3. Generate JWT secret:
   ```bash
   php artisan jwt:secret
   ```

4. Configure JWT in User model and auth guards

### API Resource Implementation
1. Create API resources for consistent JSON transformation:
   ```bash
   php artisan make:resource CarResource
   ```

2. Implement resource collections for pagination:
   ```bash
   php artisan make:resource CarCollection
   ```

### API Documentation
1. Install Swagger UI for Laravel:
   ```bash
   composer require "darkaonline/l5-swagger"
   ```

2. Publish Swagger configuration:
   ```bash
   php artisan vendor:publish --provider "L5Swagger\L5SwaggerServiceProvider"
   ```

3. Add Swagger annotations to controllers and models

4. Generate Swagger documentation:
   ```bash
   php artisan l5-swagger:generate
   ```

## Testing Guidelines

### API Testing
1. Create feature tests for each endpoint:
   ```bash
   php artisan make:test CarApiTest
   ```

2. Test authentication, authorization, and validation

3. Test success and error scenarios

4. Test rate limiting and security features

### Postman Collection
1. Create a Postman collection for manual testing

2. Include environment variables for base URL and tokens

3. Document request and response examples

## Security Considerations

### API Security Checklist
- [ ] Implement proper authentication (JWT)
- [ ] Use HTTPS for all API traffic
- [ ] Implement rate limiting to prevent abuse
- [ ] Validate all input data
- [ ] Implement proper authorization for each endpoint
- [ ] Use secure headers (CORS, Content-Security-Policy, etc.)
- [ ] Log all API requests for auditing
- [ ] Implement token expiration and refresh mechanisms
- [ ] Sanitize all output data to prevent XSS
- [ ] Use parameterized queries to prevent SQL injection

## Project Management

### Daily Tasks
1. Review assigned API tasks in the project management document
2. Update task status as you progress
3. Document any issues or blockers
4. Commit code regularly with descriptive commit messages
5. Create pull requests for code review

### Code Review Process
1. Submit pull requests for each completed API endpoint
2. Ensure tests are passing
3. Address code review feedback
4. Update documentation as needed

### Definition of Done
An API endpoint is considered complete when:
- Endpoint is implemented according to specifications
- Authentication and authorization are properly implemented
- Input validation is in place
- Tests are written and passing
- Documentation is updated
- Code has been reviewed and approved

## Resources

### Laravel API Documentation
- [Laravel Documentation](https://laravel.com/docs)
- [Laravel Sanctum Documentation](https://laravel.com/docs/sanctum)
- [JWT Auth Documentation](https://github.com/PHP-Open-Source-Saver/jwt-auth)

### RESTful API Best Practices
- [REST API Tutorial](https://restfulapi.net/)
- [API Design Guide](https://cloud.google.com/apis/design)
- [JSON:API Specification](https://jsonapi.org/)

### Swagger/OpenAPI Documentation
- [Swagger Documentation](https://swagger.io/docs/)
- [OpenAPI Specification](https://swagger.io/specification/)
- [L5-Swagger Documentation](https://github.com/DarkaOnLine/L5-Swagger)

## Contact Information
For questions or assistance, please contact the project lead or refer to the project documentation.
