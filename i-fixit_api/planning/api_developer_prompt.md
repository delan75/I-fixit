# I-fixit API Developer Prompt

## Project Overview
You are tasked with developing a RESTful API for the I-fixit car investment tracking system as part of Sprint 8: API and Integration. The I-fixit application is built with Laravel, MySQL, Blade, Livewire, Bootstrap 5, and Alpine.js, and is designed for the South African market using Rand (R) as currency.

The API will serve as the foundation for future integration with a Python microservice for auction data analysis and opportunity identification. Your goal is to implement a secure, well-documented API that follows RESTful principles and uses JWT authentication.

## Key Tasks

1. **Design RESTful API endpoints (T-060)**
   - Create a comprehensive API design following REST principles
   - Define resource-oriented endpoints with consistent naming conventions
   - Implement proper HTTP methods (GET, POST, PATCH, DELETE)
   - Design consistent request/response formats

2. **Implement JWT authentication for API (T-061)**
   - Set up Laravel Sanctum for API token authentication
   - Implement JWT (JSON Web Tokens) for stateless authentication
   - Create login, refresh, and logout endpoints
   - Implement token expiration and refresh mechanisms

3. **Create car data API endpoints (T-062)**
   - Implement endpoints for retrieving, creating, updating, and deleting car data
   - Include endpoints for related data (parts, labor, painting, damaged parts, images)
   - Implement filtering, sorting, and pagination
   - Create comprehensive financial summary endpoint

4. **Implement opportunity API endpoints (T-063)**
   - Create endpoints for managing auction opportunities
   - Implement status management for opportunities
   - Design endpoints to support future Python microservice integration
   - Include filtering and sorting capabilities

5. **Create user preferences API endpoints (T-064)**
   - Implement endpoints for retrieving and updating user preferences
   - Include role-based access control for admin operations
   - Support notification preferences management
   - Implement validation for preference settings

6. **Implement notification API endpoints (T-065)**
   - Create endpoints for retrieving and managing notifications
   - Implement endpoints for creating notifications from external services
   - Support marking notifications as read individually or in bulk
   - Include filtering capabilities for notifications

7. **Create API documentation (T-066)**
   - Implement OpenAPI/Swagger documentation for all endpoints
   - Include request/response examples
   - Document authentication requirements
   - Create a Postman collection for testing

## Technical Requirements

### API Architecture
- Follow RESTful API design principles with Ntier architecture (repositories, services, views)
- Keep the directory simple with just new files for repositories, services, and serializers, urls, and views. no need to create new folders. 
- Write tests for all endpoints, repositories, and services (max 8 each)
- Use JSON for all request and response payloads
- Implement API versioning via URL path (e.g., `/api/v1/`)
- Ensure all endpoints are properly authenticated and authorized
- Implement consistent error handling and response formats
- Use proper HTTP status codes for different scenarios
- Implement rate limiting to prevent abuse

### Authentication & Security
- Use Laravel Sanctum for API token authentication
- Implement JWT for stateless authentication
- Secure all endpoints with proper middleware
- Implement role-based access control
- Validate all input data
- Use HTTPS for all API traffic
- Log all API requests for auditing

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

## Implementation Steps

### 1. Set Up API Infrastructure
- Configure Laravel Sanctum and JWT authentication
- Set up API routes with versioning
- Create base controller with common functionality
- Implement middleware for authentication and authorization
- Set up API resources for consistent JSON transformation

### 2. Implement Authentication Endpoints
- Create login endpoint that returns JWT token
- Implement token refresh endpoint
- Create logout endpoint to invalidate tokens
- Add middleware to protect routes

### 3. Develop Resource Endpoints
- Implement CRUD operations for each resource
- Create API resources for consistent JSON transformation
- Add validation rules for all input data
- Implement filtering, sorting, and pagination
- Add proper error handling

### 4. Add Documentation
- Add OpenAPI/Swagger annotations to controllers and models
- Generate API documentation
- Create Postman collection for testing
- Document authentication flow and examples

### 5. Test API Endpoints
- Write feature tests for each endpoint
- Test authentication and authorization
- Test validation rules
- Test success and error scenarios

## Project Management Guidelines

### Daily Workflow
1. Review assigned tasks in the project management document
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

### Project Documentation
- API Development Guide: `planning/api_development_guide.md`
- API Design Document: `planning/api_design.md`
- System Architecture: `planning/system_architecture.md`
- Technical Specifications: `planning/technical_specifications.md`

### Laravel Resources
- [Laravel Documentation](https://laravel.com/docs)
- [Laravel Sanctum Documentation](https://laravel.com/docs/sanctum)
- [JWT Auth Documentation](https://github.com/PHP-Open-Source-Saver/jwt-auth)

### API Design Resources
- [REST API Tutorial](https://restfulapi.net/)
- [API Design Guide](https://cloud.google.com/apis/design)
- [JSON:API Specification](https://jsonapi.org/)

## Contact Information
For questions or assistance, please contact the project lead or refer to the project documentation.

## Deliverables
By the end of Sprint 8 (September 7, 2025), you should deliver:
1. Fully implemented API endpoints as specified
2. Comprehensive API documentation using OpenAPI/Swagger
3. Postman collection for testing
4. Feature tests for all endpoints
5. Updated project documentation

Remember to follow the mobile-first approach and ensure all API responses are optimized for both desktop and mobile clients. The API should be designed with future expansion in mind, particularly for integration with the planned Python microservice for auction data analysis.
