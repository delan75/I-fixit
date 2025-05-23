# I-fixit Database Design

## Overview
This document outlines the database structure for the I-fixit car investment tracking system. The database is designed to track vehicles through three phases: bidding/purchase, repair/parts, and dealership/sale.

## Database Tables

### 1. Users Table
Stores user information for authentication and authorization.

```
users
- id (primary key)
- name (string)
- email (string, unique)
- password (string, hashed)
- role (enum: admin, manager, dealership, repair, supplier, viewer)
- email_verified_at (timestamp, nullable)
- remember_token (string, nullable)
- created_at (timestamp)
- updated_at (timestamp)
```

### 2. Cars Table
Stores the main vehicle information.

```
cars
- id (primary key)
- user_id (foreign key to users)
- make (string)
- model (string)
- year (integer)
- vin (string, nullable)
- registration_number (string, nullable)
- color (string, nullable)
- body_type (string)
- engine_size (string, nullable)
- fuel_type (string)
- transmission (string)
- mileage (integer)
- features (json) - For special features like sunroof, custom rims, etc.
- purchase_date (date)
- purchase_price (decimal)
- auction_house (string, nullable)
- auction_lot_number (string, nullable)
- damage_description (text)
- damage_severity (enum: light, moderate, severe)
- operational_status (enum: running, non-running)
- current_phase (enum: bidding, fixing, dealership, sold)
- repair_start_date (date, nullable)
- repair_end_date (date, nullable)
- dealership_date (date, nullable)
- sold_date (date, nullable)
- transportation_cost (decimal, default: 0)
- registration_papers_cost (decimal, default: 0)
- number_plates_cost (decimal, default: 0)
- dealership_discount (decimal, default: 0)
- other_costs (decimal, default: 0)
- other_costs_description (text, nullable)
- estimated_repair_cost (decimal, default: 0)
- estimated_market_value (decimal, nullable)
- notes (text, nullable)
- created_at (timestamp)
- updated_at (timestamp)
```

### 3. Car Images Table
Stores images related to each car.

```
car_images
- id (primary key)
- car_id (foreign key to cars)
- image_path (string)
- image_type (enum: before_repair, during_repair, after_repair, damage, other)
- description (string, nullable)
- created_at (timestamp)
- updated_at (timestamp)
```

### 4. Parts Table
Tracks replacement parts purchased for each car.

```
parts
- id (primary key)
- car_id (foreign key to cars)
- name (string)
- description (text, nullable)
- condition (enum: new, used, refurbished)
- quantity (integer)
- unit_price (decimal)
- total_price (decimal)
- purchase_date (date)
- installation_date (date, nullable)
- supplier_id (foreign key to suppliers)
- created_at (timestamp)
- updated_at (timestamp)
```

### 5. Suppliers Table
Stores information about parts suppliers.

```
suppliers
- id (primary key)
- name (string)
- contact_person (string, nullable)
- phone (string, nullable)
- email (string, nullable)
- address (text, nullable)
- website (string, nullable)
- notes (text, nullable)
- created_at (timestamp)
- updated_at (timestamp)
```

### 6. Labor Table
Tracks labor costs for repairs.

```
labor
- id (primary key)
- car_id (foreign key to cars)
- service_type (string)
- description (text)
- provider_name (string)
- provider_contact (string, nullable)
- hours (decimal, nullable)
- hourly_rate (decimal, nullable)
- total_cost (decimal)
- service_date (date)
- completion_date (date, nullable)
- created_at (timestamp)
- updated_at (timestamp)
```

### 7. Painting Table
Tracks painting costs.

```
painting
- id (primary key)
- car_id (foreign key to cars)
- painting_type (enum: full, partial)
- areas_covered (text, nullable)
- provider_name (string)
- provider_contact (string, nullable)
- material_cost (decimal, nullable)
- labor_cost (decimal, nullable)
- total_cost (decimal)
- start_date (date)
- completion_date (date, nullable)
- created_at (timestamp)
- updated_at (timestamp)
```

### 8. Sales Table
Tracks the sales process and outcome.

```
sales
- id (primary key)
- car_id (foreign key to cars)
- listing_date (date)
- asking_price (decimal)
- platform (string) - Dealership, online marketplace, etc.
- selling_price (decimal, nullable)
- sale_date (date, nullable)
- buyer_name (string, nullable)
- buyer_contact (string, nullable)
- commission (decimal, nullable)
- fees (decimal, nullable)
- notes (text, nullable)
- created_at (timestamp)
- updated_at (timestamp)
```

### 9. Documents Table
Stores documents related to each car.

```
documents
- id (primary key)
- car_id (foreign key to cars)
- document_type (string) - Registration, insurance, service history, etc.
- file_path (string)
- description (string, nullable)
- upload_date (date)
- created_at (timestamp)
- updated_at (timestamp)
```

### 10. Damaged Parts Table
Stores information about damaged parts identified during assessment.

```
damaged_parts
- id (primary key)
- car_id (foreign key to cars)
- part_name (string)
- part_location (string) - e.g., front, rear, driver side, passenger side
- damage_description (text)
- estimated_repair_cost (decimal)
- needs_replacement (boolean)
- image_path (string, nullable)
- is_repaired (boolean, default: false)
- created_at (timestamp)
- updated_at (timestamp)
```

### 11. Opportunities Table (for future Python integration)
Stores potential buying opportunities identified by the Python microservice.

```
opportunities
- id (primary key)
- source (string) - Auction site source
- listing_url (string)
- make (string)
- model (string)
- year (integer)
- auction_end_date (datetime, nullable)
- current_bid (decimal, nullable)
- damage_description (text, nullable)
- image_urls (json, nullable)
- estimated_repair_cost (decimal, nullable)
- estimated_market_value (decimal, nullable)
- potential_profit (decimal, nullable)
- opportunity_score (integer) - 0-100 score
- status (enum: new, viewed, interested, bidding, won, lost, expired)
- created_at (timestamp)
- updated_at (timestamp)
```

### 12. User Preferences Table (for future Python integration)
Stores user preferences for opportunity notifications.

```
user_preferences
- id (primary key)
- user_id (foreign key to users)
- preferred_makes (json, nullable)
- preferred_models (json, nullable)
- min_year (integer, nullable)
- max_year (integer, nullable)
- min_profit (decimal, nullable)
- max_investment (decimal, nullable)
- notification_email (boolean, default: true)
- notification_sms (boolean, default: false)
- notification_app (boolean, default: true)
- created_at (timestamp)
- updated_at (timestamp)
```

### 13. Notifications Table
Stores system notifications.

```
notifications
- id (primary key)
- user_id (foreign key to users)
- type (string)
- notifiable_type (string)
- notifiable_id (integer)
- data (json)
- read_at (timestamp, nullable)
- created_at (timestamp)
- updated_at (timestamp)
```

### 14. Activity Log Table
Tracks user activity for auditing purposes.

```
activity_log
- id (primary key)
- user_id (foreign key to users, nullable)
- action (string)
- entity_type (string)
- entity_id (integer)
- old_values (json, nullable)
- new_values (json, nullable)
- ip_address (string, nullable)
- user_agent (string, nullable)
- created_at (timestamp)
```

## Relationships

1. **Users to Cars**: One-to-Many (A user can have multiple cars)
2. **Cars to Car Images**: One-to-Many (A car can have multiple images)
3. **Cars to Parts**: One-to-Many (A car can have multiple parts)
4. **Suppliers to Parts**: One-to-Many (A supplier can provide multiple parts)
5. **Cars to Labor**: One-to-Many (A car can have multiple labor entries)
6. **Cars to Painting**: One-to-Many (A car can have multiple painting entries)
7. **Cars to Sales**: One-to-One (A car has one sales record)
8. **Cars to Documents**: One-to-Many (A car can have multiple documents)
9. **Cars to Damaged Parts**: One-to-Many (A car can have multiple damaged parts)
10. **Users to Opportunities**: Many-to-Many (Users can be interested in multiple opportunities)
11. **Users to User Preferences**: One-to-One (A user has one set of preferences)
12. **Users to Notifications**: One-to-Many (A user can have multiple notifications)
13. **Users to Activity Log**: One-to-Many (A user can have multiple activity log entries)

## Indexes
- Index on `cars.make`, `cars.model`, and `cars.year` for faster searching
- Index on `cars.current_phase` for filtering by phase
- Index on `parts.car_id` for faster retrieval of parts for a specific car
- Index on `labor.car_id` for faster retrieval of labor entries for a specific car
- Index on `painting.car_id` for faster retrieval of painting entries for a specific car
- Index on `sales.car_id` for faster retrieval of sales information for a specific car
- Index on `opportunities.status` for filtering by status
- Index on `notifications.user_id` and `notifications.read_at` for faster retrieval of unread notifications

## Additional Tables for New Features

### 1. Analytics Dashboard

```
analytics_widgets
- id (primary key)
- user_id (foreign key to users)
- widget_type (enum: profit_trend, repair_cost, roi_comparison, selling_time, custom)
- title (string)
- description (text, nullable)
- settings (json) - For widget-specific configuration
- position (integer) - For ordering on dashboard
- size (enum: small, medium, large)
- is_active (boolean)
- created_at (timestamp)
- updated_at (timestamp)
```

```
analytics_data_points
- id (primary key)
- data_type (enum: profit, cost, roi, time, custom)
- reference_id (string) - ID of the referenced entity (car, make, model, etc.)
- reference_type (string) - Type of the referenced entity
- value (decimal)
- date (date)
- metadata (json, nullable) - Additional contextual data
- created_at (timestamp)
- updated_at (timestamp)
```

```
predictive_models
- id (primary key)
- model_type (enum: selling_time, price_prediction, repair_cost, roi)
- name (string)
- description (text, nullable)
- parameters (json) - Model parameters
- accuracy (decimal, nullable)
- last_trained (timestamp, nullable)
- is_active (boolean)
- created_at (timestamp)
- updated_at (timestamp)
```

### 2. Supplier Marketplace

```
suppliers_marketplace
- id (primary key)
- supplier_id (foreign key to suppliers)
- business_name (string)
- business_description (text, nullable)
- logo_path (string, nullable)
- website (string, nullable)
- business_hours (json, nullable)
- rating (decimal, nullable)
- is_verified (boolean)
- status (enum: active, inactive, suspended)
- created_at (timestamp)
- updated_at (timestamp)
```

```
supplier_parts
- id (primary key)
- supplier_id (foreign key to suppliers)
- part_name (string)
- part_number (string, nullable)
- description (text, nullable)
- condition (enum: new, used, refurbished)
- price (decimal)
- quantity_available (integer)
- compatible_makes (json, nullable)
- compatible_models (json, nullable)
- compatible_years (json, nullable)
- image_path (string, nullable)
- is_featured (boolean)
- status (enum: active, inactive, out_of_stock)
- created_at (timestamp)
- updated_at (timestamp)
```

```
part_orders
- id (primary key)
- user_id (foreign key to users)
- supplier_id (foreign key to suppliers)
- car_id (foreign key to cars, nullable)
- order_number (string)
- status (enum: pending, approved, shipped, delivered, cancelled)
- total_amount (decimal)
- shipping_address (text, nullable)
- shipping_cost (decimal, nullable)
- tracking_number (string, nullable)
- notes (text, nullable)
- created_at (timestamp)
- updated_at (timestamp)
```

```
order_items
- id (primary key)
- order_id (foreign key to part_orders)
- supplier_part_id (foreign key to supplier_parts)
- quantity (integer)
- unit_price (decimal)
- total_price (decimal)
- status (enum: pending, shipped, delivered, returned)
- created_at (timestamp)
- updated_at (timestamp)
```

```
supplier_reviews
- id (primary key)
- user_id (foreign key to users)
- supplier_id (foreign key to suppliers)
- order_id (foreign key to part_orders, nullable)
- rating (integer) - 1 to 5
- review_text (text, nullable)
- is_verified_purchase (boolean)
- created_at (timestamp)
- updated_at (timestamp)
```

### 3. Public Car Listings

```
public_car_listings
- id (primary key)
- car_id (foreign key to cars)
- title (string)
- description (text)
- price (decimal)
- is_negotiable (boolean)
- contact_name (string)
- contact_email (string, nullable)
- contact_phone (string, nullable)
- location (string)
- is_featured (boolean)
- views_count (integer)
- status (enum: active, sold, inactive)
- created_at (timestamp)
- updated_at (timestamp)
```

```
listing_inquiries
- id (primary key)
- listing_id (foreign key to public_car_listings)
- name (string)
- email (string)
- phone (string, nullable)
- message (text)
- status (enum: new, read, replied, spam)
- created_at (timestamp)
- updated_at (timestamp)
```

### 4. Auction Integration

```
auction_platforms
- id (primary key)
- name (string)
- api_endpoint (string, nullable)
- api_key (string, nullable)
- api_secret (string, nullable)
- status (enum: active, inactive)
- created_at (timestamp)
- updated_at (timestamp)
```

```
auction_listings
- id (primary key)
- platform_id (foreign key to auction_platforms)
- external_id (string) - ID from the auction platform
- title (string)
- description (text, nullable)
- make (string)
- model (string)
- year (integer, nullable)
- vin (string, nullable)
- color (string, nullable)
- mileage (integer, nullable)
- damage_description (text, nullable)
- starting_bid (decimal, nullable)
- current_bid (decimal, nullable)
- estimated_value (decimal, nullable)
- auction_start (timestamp, nullable)
- auction_end (timestamp, nullable)
- location (string, nullable)
- images (json, nullable) - Array of image URLs
- opportunity_score (integer, nullable) - 0 to 100
- status (enum: upcoming, active, ended, purchased, passed)
- created_at (timestamp)
- updated_at (timestamp)
```

```
auction_bids
- id (primary key)
- user_id (foreign key to users)
- listing_id (foreign key to auction_listings)
- amount (decimal)
- max_bid (decimal, nullable) - For auto-bidding
- status (enum: active, outbid, won, lost)
- created_at (timestamp)
- updated_at (timestamp)
```

### 5. Document Generation and E-Signing

```
document_templates
- id (primary key)
- name (string)
- description (text, nullable)
- type (enum: sales_contract, repair_authorization, invoice, receipt, other)
- content (text) - HTML template with placeholders
- created_by (foreign key to users)
- is_active (boolean)
- created_at (timestamp)
- updated_at (timestamp)
```

```
generated_documents
- id (primary key)
- template_id (foreign key to document_templates)
- user_id (foreign key to users) - Who generated it
- reference_id (string) - ID of the referenced entity (car, order, etc.)
- reference_type (string) - Type of the referenced entity
- title (string)
- file_path (string)
- version (integer)
- status (enum: draft, final, signed, voided)
- created_at (timestamp)
- updated_at (timestamp)
```

```
document_signatures
- id (primary key)
- document_id (foreign key to generated_documents)
- signer_name (string)
- signer_email (string)
- signer_role (string, nullable)
- signature_image (string, nullable) - Path to signature image
- ip_address (string, nullable)
- signed_at (timestamp, nullable)
- verification_code (string, nullable)
- status (enum: pending, signed, rejected, expired)
- created_at (timestamp)
- updated_at (timestamp)
```

## Views

### 1. Car Investment Summary View
```
car_investment_summary
- car_id
- make
- model
- year
- purchase_price
- parts_cost (sum of parts.total_price)
- labor_cost (sum of labor.total_cost)
- painting_cost (sum of painting.total_cost)
- total_investment
- selling_price
- profit_loss
- roi_percentage
- days_in_repair
- days_at_dealership
- total_days
```

### 2. Profit by Make/Model View
```
profit_by_make_model
- make
- model
- count
- avg_purchase_price
- avg_repair_cost
- avg_selling_price
- avg_profit
- avg_roi
```

### 3. Analytics Dashboard Views

```
repair_cost_benchmarks
- make
- model
- year_range
- damage_severity
- avg_parts_cost
- avg_labor_cost
- avg_painting_cost
- avg_total_repair_cost
- sample_size
```

```
selling_time_predictions
- make
- model
- year_range
- price_range
- condition
- avg_days_at_dealership
- optimal_price_range
- confidence_score
- sample_size
```

```
roi_comparison
- make
- model
- year
- avg_purchase_price
- avg_repair_cost
- avg_selling_price
- avg_roi
- market_comparison
- sample_size
```

## Database Migrations
The database will be implemented using Laravel migrations to ensure version control and easy deployment. Each table will have its own migration file following Laravel naming conventions.

## Data Validation
Data validation will be implemented at both the database level (using constraints) and the application level (using Laravel's validation system) to ensure data integrity.

## Future Considerations
1. **Scaling**: As the database grows, consider implementing partitioning for historical data
2. **Performance**: Monitor query performance and add indexes as needed
3. **Integration**: Design API endpoints for the Python microservice to interact with the database
4. **Backup**: Implement regular database backups
5. **Archiving**: Create an archiving strategy for completed car investments older than a certain period
