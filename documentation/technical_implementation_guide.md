# I-fixit Technical Implementation Guide

## Overview

This guide provides detailed technical information for developers working on the I-fixit car investment tracking system. It covers the system architecture, code organization, key components, and implementation details.

## Table of Contents

1. [System Architecture](#system-architecture)
2. [Technology Stack](#technology-stack)
3. [Code Organization](#code-organization)
4. [Database Structure](#database-structure)
5. [Key Components](#key-components)
6. [Authentication and Authorization](#authentication-and-authorization)
7. [File Management](#file-management)
8. [Notification System](#notification-system)
9. [Reporting Engine](#reporting-engine)
10. [API Integration](#api-integration)
11. [Testing](#testing)
12. [Deployment](#deployment)

## System Architecture

I-fixit follows a Model-View-Controller (MVC) architecture with additional service layers for complex business logic. The system consists of:

1. **Laravel Backend**: Handles data processing, business logic, and API endpoints
2. **Blade Templates with Livewire**: Provides dynamic frontend interfaces
3. **MySQL Database**: Stores all application data
4. **Python Django API**: External service for web scraping and machine learning (in development)

### Architecture Diagram

```
┌─────────────────┐     ┌─────────────────┐     ┌─────────────────┐
│                 │     │                 │     │                 │
│  Web Browser    │◄────┤  Laravel App    │◄────┤  MySQL Database │
│  (User Interface)│     │  (Application)  │     │  (Data Storage) │
│                 │────►│                 │────►│                 │
└─────────────────┘     └────────┬────────┘     └─────────────────┘
                                 │
                                 │
                        ┌────────▼────────┐
                        │                 │
                        │  Python Django  │
                        │  (API Service)  │
                        │                 │
                        └─────────────────┘
```

## Technology Stack

### Backend
- **Framework**: Laravel 11
- **PHP Version**: 8.2+
- **Database**: MySQL 8.0+
- **Authentication**: Laravel Breeze/Jetstream
- **Authorization**: Role-based access control
- **API**: RESTful API with JWT authentication

### Frontend
- **Template Engine**: Laravel Blade
- **JavaScript Framework**: Alpine.js
- **CSS Framework**: Bootstrap 5
- **Icons**: Font Awesome
- **Interactive Components**: Livewire
- **Charts**: Chart.js

### External Services
- **Notifications**: WebSockets/Pusher
- **Email**: SMTP service
- **File Storage**: Local or S3-compatible storage
- **Machine Learning**: Python Django API (in development)

## Code Organization

The codebase follows Laravel's standard directory structure with some additional organization:

```
app/
├── Console/              # Console commands and scheduled tasks
├── Exceptions/           # Exception handlers
├── Http/
│   ├── Controllers/      # Request handlers
│   ├── Middleware/       # Request filters
│   └── Requests/         # Form validation
├── Models/               # Eloquent models
├── Policies/             # Authorization policies
├── Providers/            # Service providers
└── Services/             # Business logic services
    ├── ActivityLogService.php
    ├── CarService.php
    ├── NotificationService.php
    ├── ReportService.php
    └── ...
```

### Key Namespaces

- `App\Models`: Database models
- `App\Http\Controllers`: Request handlers
- `App\Services`: Business logic services
- `App\Policies`: Authorization policies

## Database Structure

The database consists of the following key tables:

1. **users**: User accounts and authentication
2. **cars**: Main vehicle information
3. **car_images**: Images associated with cars
4. **damaged_parts**: Damaged components of cars
5. **parts**: Replacement parts for repairs
6. **suppliers**: Part suppliers information
7. **labor**: Labor costs for repairs
8. **painting**: Painting costs for repairs
9. **sales**: Sales information for cars
10. **documents**: Documents associated with cars
11. **reports**: Generated reports
12. **report_types**: Types of available reports
13. **notifications**: User notifications
14. **activity_logs**: System activity tracking

### Key Relationships

- Users to Cars: One-to-Many
- Cars to Parts: One-to-Many
- Cars to Labor: One-to-Many
- Cars to Painting: One-to-Many
- Cars to Sales: One-to-One
- Cars to Damaged Parts: One-to-Many
- Suppliers to Parts: One-to-Many

## Key Components

### Car Management

The car management system tracks vehicles through four phases:

1. **Bidding/Purchase**: Initial acquisition
2. **Fixing**: Repair and restoration
3. **Dealership**: Listed for sale
4. **Sold**: Completed sale

#### Implementation Details

- `CarController`: Handles CRUD operations for cars
- `Car` model: Represents vehicle data
- `CarPolicy`: Controls access to car operations
- `CarService`: Contains business logic for car operations

#### Phase Transitions

Phase transitions are managed through a combination of controller methods and middleware:

1. **PhaseTransitionMiddleware**: Enforces business rules for phase transitions
   - Validates that transitions follow the correct sequence (bidding → fixing → dealership → sold)
   - Ensures required data exists for each phase (e.g., purchase date for fixing phase)
   - Prevents invalid operations (e.g., adding sales info for cars not in dealership phase)
   - Provides clear error messages to users
   - Logs invalid transition attempts

2. **Controller-level validation**:
   - `SaleController`: Validates car is in dealership phase before allowing sale operations
   - `PartController`: Ensures car is in fixing phase before allowing part operations
   - `DealershipController`: Verifies car is in dealership phase for discount operations

3. **Exception handling**:
   - Try-catch blocks with appropriate error logging
   - User-friendly error messages
   - Redirects to appropriate pages on error

### Cost Tracking

The system tracks various costs associated with each car:

1. **Parts**: Replacement components
2. **Labor**: Repair work
3. **Painting**: Body painting
4. **Other Costs**: Transportation, registration, etc.

#### Implementation Details

- `PartController`, `LaborController`, `PaintingController`: Handle CRUD operations
- `Part`, `Labor`, `Painting` models: Represent cost data
- `CarService::calculateTotalInvestment()`: Computes total investment

### Financial Analysis

The system provides financial analysis for each car:

1. **Total Investment**: Sum of all costs
2. **Projected Profit/Loss**: Based on estimated market value
3. **Actual Profit/Loss**: Based on selling price (for sold cars)
4. **ROI**: Return on investment percentage

#### Implementation Details

- `CarService::getFinancialSummary()`: Calculates financial metrics
- `ReportService::generateProfitabilityReport()`: Creates profitability reports

## Authentication and Authorization

### Authentication

The system uses Laravel Breeze/Jetstream for authentication with:

1. **Email/Password**: Standard login
2. **Two-Factor Authentication**: Optional enhanced security
3. **Remember Me**: Persistent sessions

#### Implementation Details

- `AuthenticatedSessionController`: Handles login/logout
- `LoginRequest`: Validates login credentials
- `TwoFactorAuthenticationController`: Manages 2FA

### Authorization

The system uses role-based access control with the following roles:

1. **Superuser**: Complete system access
2. **Admin**: Management access
3. **Manager**: Operational access
4. **Dealership**: Sales-focused access
5. **Repair**: Repair-focused access
6. **Supplier**: Limited parts access
7. **Viewer**: Read-only access

#### Implementation Details

- `AuthServiceProvider`: Registers policies
- `AdminAccess`, `SuperuserAccess` middleware: Role-based filters
- Model policies (e.g., `CarPolicy`, `UserPolicy`): Define permissions

## File Management

The system manages various file types:

1. **Car Images**: Photos of vehicles
2. **Damaged Part Images**: Photos of damaged components
3. **Documents**: PDFs and other documents

### Implementation Details

- `CarImageController`: Handles image uploads and organization
  - Implements structured storage by image type (before_repair, during_repair, after_repair, damage, dealership)
  - Generates descriptive filenames with car details (year, make, model)
  - Provides image migration functionality to reorganize existing images
  - Includes error handling for failed uploads
- `DocumentController`: Manages document uploads
- Client-side image handling:
  - `car-image-handler.js`: Provides fallback for broken images
  - Uses data URI SVG placeholders for missing images
- Storage configuration in `config/filesystems.php`
- Symbolic link from `public/storage` to `storage/app/public` via `php artisan storage:link`

## Notification System

The notification system provides real-time updates to users:

1. **In-App Notifications**: Using WebSockets/Pusher
2. **Email Notifications**: For important events
3. **Notification Preferences**: User-configurable

### Implementation Details

- `NotificationController`: Manages notifications
- `NotificationService`: Centralizes notification logic
- Notification classes in `app/Notifications/`
- WebSockets configuration in `config/broadcasting.php`

## Reporting Engine

The reporting engine generates various reports:

1. **Profitability Analysis**: Financial performance
2. **Repair Cost Analysis**: Cost breakdown
3. **Sales Performance**: Sales metrics
4. **Time at Dealership**: Time-to-sale analysis
5. **Investment Summary**: Overall investment metrics

### Implementation Details

- `ReportController`: Handles report generation
- `ReportService`: Contains report generation logic
- `Report` and `ReportType` models: Represent report data
- Chart.js integration for visualizations

## API Integration

The system integrates with a Python Django API for advanced features:

1. **Web Scraping**: Auction opportunity identification
2. **Machine Learning**: Price prediction and opportunity scoring
3. **Market Analysis**: Trend identification

### Implementation Details

- API endpoints defined in `routes/api.php`
- JWT authentication for secure communication
- API controllers in `app/Http/Controllers/Api/`
- Python Django API (separate repository)

## Testing

The testing strategy includes:

1. **Unit Tests**: Testing individual components
2. **Feature Tests**: Testing user workflows
3. **API Tests**: Testing API endpoints
4. **Browser Tests**: Testing UI interactions

### Implementation Details

- Tests located in `tests/` directory
- PHPUnit configuration in `phpunit.xml`
- Test factories in `database/factories/`
- Test seeders in `database/seeders/`

## Deployment

The deployment process includes:

1. **Environment Setup**: Server configuration
2. **Application Deployment**: Code and assets
3. **Database Migration**: Schema and data
4. **Cache Configuration**: Optimization for production
5. **Monitoring Setup**: Performance and error tracking

### Implementation Details

- Production environment configuration in `.env.production`
- Deployment scripts in `scripts/` directory
- Server requirements documented in `server-requirements.md`
- Backup configuration in `config/backup.php`

## Development Workflow

1. **Feature Branches**: Create a branch for each feature
2. **Pull Requests**: Submit PRs for code review
3. **Automated Testing**: Run tests before merging
4. **Code Style**: Follow PSR-12 coding standards
5. **Documentation**: Update docs for new features

### Implementation Details

- Git workflow documented in `CONTRIBUTING.md`
- Code style enforced with PHP_CodeSniffer
- CI/CD configuration in `.github/workflows/`
