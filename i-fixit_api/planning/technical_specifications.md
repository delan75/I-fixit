# I-fixit Technical Specifications

## Overview
This document outlines the technical specifications for the I-fixit car investment tracking system based on client requirements and feedback.

## Technology Stack

### Backend
- **Framework**: Laravel 11
- **PHP Version**: 8.2+
- **Database**: MySQL
- **Authentication**: Laravel Breeze/Jetstream with Two-Factor Authentication
- **Authorization**: Role-based access control via middleware
- **API Authentication**: JWT tokens for future Python microservice integration

### Frontend
- **Template Engine**: Laravel Blade with Livewire for reactivity
- **CSS Framework**: Bootstrap 5
- **JavaScript Framework**: Alpine.js for frontend interactivity
- **Icons**: Font Awesome
- **Charts/Graphs**: Chart.js for data visualization

### Infrastructure
- **Hosting**: Shared hosting environment
- **File Storage**: Local storage with compression and thumbnail generation
- **Email**: SMTP configuration
- **Notifications**: Real-time notifications via WebSockets/Pusher
- **Version Control**: GitHub
- **Deployment**: CI/CD pipeline

## Database Optimization Strategy
- Implement appropriate indexes on frequently queried columns
- Use eager loading to prevent N+1 query problems
- Implement query caching for frequently accessed data
- Use database transactions for data integrity
- Implement soft deletes for important records
- Create database views for complex reporting queries
- Regular database maintenance and optimization

## File Management Strategy
- Implement file compression for uploaded images
- Generate thumbnails for gallery views
- Organize files by car ID and type (before_repair, during_repair, after_repair)
- Implement validation for file types and sizes
- Create a centralized file service for consistent handling
- Regular cleanup of orphaned files

## Authentication and Security
- Implement Laravel Breeze/Jetstream for authentication
- Enable Two-Factor Authentication as an optional feature
  - Google Authenticator compatible TOTP implementation
  - QR code for easy setup
  - Recovery codes for backup access
  - User-controlled activation/deactivation
- Role-based access control via middleware
- CSRF protection for all forms
- Input validation and sanitization
- Secure API endpoints with JWT tokens
- Regular security audits and updates

## Notification System
- Real-time notifications via WebSockets/Pusher
- Email notifications for important events
- Database storage of all notifications for history
- Notification preferences by user
- Centralized notification service for consistent handling
- Batch processing for bulk notifications

## Reporting Engine
- Centralized reporting service
- Support for multiple export formats (PDF, Excel, CSV)
- Scheduled report generation
- Saved report configurations
- Filterable and sortable data
- Integration with Chart.js for visualizations

## Car Phase Transition Rules
- Configurable conditions for phase transitions
- Admin ability to override transition requirements
- Notification triggers for phase changes
- Validation of required data before transition
- Historical tracking of phase changes

## Profit Calculation Components
- Purchase price
- Parts costs
- Labor costs
- Painting costs
- Transportation costs
- Registration papers costs
- Number plates costs
- Dealership discounts
- Other miscellaneous costs (configurable)

## API Design for Python Integration
- RESTful API endpoints
- JWT authentication
- Rate limiting
- Versioned API (v1)
- Comprehensive documentation
- Error handling and logging
- Endpoints for:
  - Car data retrieval
  - Opportunity submission
  - User preferences
  - Notifications

## Mobile Responsiveness
- Mobile-first design approach
- Responsive layouts for all screen sizes
- Touch-friendly UI elements
- Optimized images and assets for mobile
- Testing on multiple devices and browsers

## Testing Strategy
- Unit tests for core functionality
- Feature tests for user workflows
- Browser tests for UI interactions
- API tests for endpoints
- Performance testing for critical operations
- Continuous integration with automated tests

## Development Methodology
- Agile development approach
- Two-week sprint cycles
- Regular client demos
- Iterative development and feedback
- Feature prioritization based on business value
- Continuous integration and deployment

## Deployment Strategy
- GitHub for version control
- CI/CD pipeline for automated testing and deployment
- Staging environment for client review
- Production deployment process
- Rollback procedures
- Backup strategy

## Car Damage Assessment Workflow
- Step-by-step UI for damage assessment during car registration
- Checklist for common damaged parts:
  - Bumper (front/rear)
  - Headlights (left/right)
  - Taillights (left/right)
  - Fenders (front/rear, left/right)
  - Doors (front/rear, driver/passenger)
  - Hood
  - Trunk/Tailgate
  - Windows/Windshield
  - Engine components
  - Transmission
  - Suspension
  - Interior components
- Option to skip individual items or entire assessment
- Automatic cost estimation based on selected damaged parts
- Ability to add custom damaged items not in the checklist
- Photo upload capability for each damaged area
- Summary view of all damaged parts and estimated repair costs

## Notification Thresholds
- Cars at dealership for more than 30 days
- Repair costs exceeding estimated budget by configurable percentage
- Cars in repair phase for more than configurable number of days
- High-scoring opportunities from Python microservice
- Parts requests pending for more than configurable number of days
- System alerts for technical issues

## Scalability Considerations
- Database design to handle 6-45+ cars per year
- Multi-tenant architecture for potential future expansion
- Performance optimization for mobile devices
- Efficient query design for reporting
- Modular code structure for maintainability
- Documentation for onboarding new developers
