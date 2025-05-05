# I-fixit System Architecture

## Overview
This document outlines the system architecture for the I-fixit car investment tracking system. The architecture consists of a Laravel 11 main application and a future Python microservice for web scraping and data analysis.

## System Components

### 1. Laravel Main Application
The core application built with Laravel 11 that handles the main business logic, user interface, and database operations.

#### Key Components:
- **Web Interface**: User-facing frontend built with Blade, Livewire, and Tailwind CSS
- **Authentication System**: User authentication and authorization
- **Business Logic Layer**: Core application logic
- **Database Layer**: Database interactions via Eloquent ORM
- **API Layer**: RESTful API endpoints for future Python integration
- **Notification System**: Email, in-app, and SMS notifications

### 2. Future Python Microservice
A separate service built with Python for web scraping, data analysis, and machine learning.

#### Key Components:
- **Web Scrapers**: Modules to scrape auction websites
- **Data Analysis Engine**: Algorithms to identify profit opportunities
- **Machine Learning Models**: Price prediction and opportunity scoring
- **API Client**: Interface to communicate with Laravel API

## Architecture Diagram
```
+----------------------------------+      +----------------------------------+
|                                  |      |                                  |
|     Laravel Main Application     |      |      Python Microservice         |
|                                  |      |                                  |
| +-------------+ +-------------+  |      | +-------------+ +-------------+  |
| |             | |             |  |      | |             | |             |  |
| |  Web UI     | |  Admin UI   |  |      | | Web Scrapers| | Data        |  |
| |             | |             |  |      | |             | | Analysis    |  |
| +-------------+ +-------------+  |      | +-------------+ +-------------+  |
|                                  |      |                                  |
| +-------------+ +-------------+  |      | +-------------+ +-------------+  |
| |             | |             |  |      | |             | |             |  |
| | Business    | | Notification|  |      | | ML Models   | | API Client  |  |
| | Logic       | | System      |  |      | |             | |             |  |
| +-------------+ +-------------+  |      | +-------------+ +-------------+  |
|                                  |      |                                  |
| +-------------+ +-------------+  |      |                                  |
| |             | |             |  |      |                                  |
| | Database    | | API         | <-----> |                                  |
| | Layer       | | Layer       |  |      |                                  |
| +-------------+ +-------------+  |      |                                  |
|                                  |      |                                  |
+----------------------------------+      +----------------------------------+
            |                                          |
            v                                          |
+----------------------------------+                   |
|                                  |                   |
|           Database               |                   |
|                                  |                   |
+----------------------------------+                   |
                                                      |
+----------------------------------+                   |
|                                  |                   |
|      External Auction Sites      | <-----------------+
|                                  |
+----------------------------------+
```

## Data Flow

### 1. Car Investment Tracking Flow
1. User registers a new car in the system
2. System guides user through damage assessment workflow
   - Step-by-step UI for identifying damaged parts
   - Option to skip individual items or entire assessment
   - Automatic cost estimation based on selected damaged parts
   - Photo upload capability for each damaged area
3. System creates car record in the database with damage assessment
4. User adds parts, labor, painting, transportation, registration, and other costs
5. System calculates total investment and estimated profit
6. User updates car status through phases based on configurable transition rules
7. User records sale information including any dealership discounts
8. System calculates final profit/loss and ROI
9. System generates reports and insights

### 2. Future Opportunity Identification Flow
1. Python service scrapes auction websites
2. Service analyzes listings for potential opportunities
3. Service calculates estimated repair costs and profit margins
4. Service scores opportunities based on historical data
5. Service sends opportunities to Laravel API
6. Laravel application stores opportunities in database
7. System notifies users of high-scoring opportunities
8. User views and acts on opportunities

## API Endpoints (for Future Integration)

### Authentication
- `POST /api/auth/login`: Authenticate Python service
- `POST /api/auth/refresh`: Refresh authentication token

### Cars
- `GET /api/cars`: Get list of cars
- `GET /api/cars/{id}`: Get specific car details
- `GET /api/cars/completed`: Get completed car investments

### Opportunities
- `POST /api/opportunities`: Create new opportunity
- `GET /api/opportunities`: Get list of opportunities
- `PUT /api/opportunities/{id}`: Update opportunity status
- `GET /api/opportunities/stats`: Get opportunity statistics

### User Preferences
- `GET /api/preferences/{user_id}`: Get user preferences
- `PUT /api/preferences/{user_id}`: Update user preferences

### Notifications
- `POST /api/notifications`: Create new notification
- `GET /api/notifications/unread`: Get unread notifications

## Security Considerations

### Authentication and Authorization
- JWT-based authentication for API access
- Role-based access control for different user types
- API rate limiting to prevent abuse

### Data Protection
- HTTPS for all communications
- Database encryption for sensitive data
- Input validation to prevent injection attacks
- CSRF protection for web forms

### API Security
- API tokens with limited scope
- Request signing for sensitive operations
- IP whitelisting for Python service

## Deployment Architecture

### Production Environment
- **Web Server**: Nginx
- **Application Server**: PHP-FPM
- **Database Server**: MySQL/PostgreSQL
- **Cache**: Redis
- **Python Environment**: Containerized Python service

### Development Environment
- **Local Development**: Laravel Sail (Docker)
- **Version Control**: Git
- **CI/CD**: GitHub Actions or similar
- **Testing**: PHPUnit for Laravel, pytest for Python

## Scalability Considerations

### Horizontal Scaling
- Stateless application design for multiple instances
- Load balancing for web traffic
- Database read replicas for scaling reads

### Vertical Scaling
- Database optimization for performance
- Caching strategies for frequently accessed data
- Background job processing for long-running tasks

## Monitoring and Logging

### Application Monitoring
- Error tracking and reporting
- Performance monitoring
- User activity logging

### Infrastructure Monitoring
- Server health monitoring
- Database performance monitoring
- API endpoint monitoring

## User Stories and Role-Based Access

### User Roles
- **Admin**: Full system access with all privileges
- **Manager**: Access to most features except system configuration
- **Dealership Staff**: Focus on sales and dealership phase
- **Repair Staff**: Focus on repair phase and parts management
- **Parts Supplier**: Limited access to parts inventory and orders
- **Viewer**: Read-only access to specific sections

### User Stories

#### As an Admin
- I want to configure system settings so that I can customize the application to business needs
- I want to manage user accounts and permissions so that I can control access to the system
- I want to access all reports and analytics so that I can make strategic business decisions
- I want to override any restrictions so that I can handle exceptional cases
- I want to audit user activities so that I can ensure proper system usage
- I want to manage the integration with the Python microservice so that I can optimize opportunity identification

#### As a Manager
- I want to view dashboards showing overall business performance so that I can track profitability
- I want to approve high-value purchases so that I can control major investments
- I want to review and analyze reports so that I can identify trends and opportunities
- I want to manage staff accounts so that I can assign appropriate access levels
- I want to set profit targets so that I can guide purchasing decisions

#### As Dealership Staff
- I want to update car status when sold so that I can track inventory accurately
- I want to record selling prices so that I can calculate final profitability
- I want to view cars in the dealership phase so that I can manage the sales process
- I want to add notes about potential buyers so that I can track customer interest
- I want to receive notifications about cars staying too long at the dealership so that I can adjust pricing

#### As Repair Staff
- I want to update car repair status so that I can track progress
- I want to add parts and labor costs so that I can maintain accurate investment records
- I want to upload photos of repairs so that I can document the process
- I want to mark a car as repair-complete so that it can move to the dealership phase
- I want to view repair history of similar cars so that I can estimate costs more accurately

#### As a Parts Supplier
- I want to view parts orders so that I can fulfill requests
- I want to update parts availability so that repair staff can plan accordingly
- I want to add new parts to the catalog so that they can be ordered
- I want to view parts usage history so that I can manage inventory better
- I want to receive notifications about new parts needs so that I can respond quickly

#### As a Viewer
- I want to view car details without editing capabilities so that I can stay informed
- I want to access specific reports so that I can analyze business performance
- I want to see investment summaries so that I can understand profitability
- I want to view historical data so that I can identify trends

### Role-Based Access Control

| Feature/Section        | Admin | Manager | Dealership | Repair | Supplier | Viewer |
|------------------------|-------|---------|------------|--------|----------|--------|
| System Configuration   | ✓     |         |            |        |          |        |
| User Management        | ✓     | ✓       |            |        |          |        |
| Dashboard              | ✓     | ✓       | ✓          | ✓      | ✓        | ✓      |
| Car Management (Add)   | ✓     | ✓       |            |        |          |        |
| Car Management (Edit)  | ✓     | ✓       | ✓          | ✓      |          |        |
| Car Management (Delete)| ✓     |         |            |        |          |        |
| Bidding Phase          | ✓     | ✓       |            |        |          | ✓      |
| Repair Phase           | ✓     | ✓       |            | ✓      |          | ✓      |
| Dealership Phase       | ✓     | ✓       | ✓          |        |          | ✓      |
| Parts Management       | ✓     | ✓       |            | ✓      | ✓        |        |
| Financial Reports      | ✓     | ✓       | ✓          |        |          | ✓      |
| Technical Reports      | ✓     | ✓       |            | ✓      |          |        |
| API Access             | ✓     | ✓       |            |        |          |        |
| Opportunity Management | ✓     | ✓       |            |        |          | ✓      |

### Implementation Approach
- Role information will be stored in the `users` table with a `role` column
- Permissions will be enforced at both the controller level and view level
- Laravel's Gate and Policy features will be used to implement authorization
- UI elements will be conditionally displayed based on user role
- API endpoints will check for appropriate permissions before processing requests

## Disaster Recovery

### Backup Strategy
- Regular database backups
- Application code versioning
- Document storage backups

### Recovery Procedures
- Database restoration process
- Application redeployment process
- Data integrity verification

## Future Expansion Considerations

### Mobile Application
- API endpoints designed for mobile consumption
- Authentication system compatible with mobile apps

### Additional Integrations
- Integration with accounting software
- Integration with CRM systems
- Integration with SMS gateways for notifications

### Advanced Analytics
- Business intelligence dashboard
- Predictive analytics for market trends
- Advanced reporting capabilities
