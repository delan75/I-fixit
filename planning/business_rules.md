# I-fixit Business Rules

## Overview
I-fixit is a car investment tracking system designed to monitor the lifecycle of accident vehicles from purchase through repair to sale. The system tracks costs, calculates profitability, and provides business insights to support future purchasing decisions.

## Car Lifecycle Rules

### Phase 1: Bidding and Purchase
1. All cars must be registered in the system with complete details (make, model, year, VIN, etc.)
2. Purchase details must include auction source, purchase date, and purchase price
3. Initial condition assessment must be recorded including damage description and photos
4. Each car must be assigned a unique identifier in the system

### Phase 2: Repair and Parts
1. All replacement parts must be recorded with:
   - Part name and description
   - Cost
   - Supplier details (name, location, contact information)
   - Purchase date
2. Labor costs must be tracked separately from parts costs
3. Spray painting costs must be recorded (full body or partial)
4. All repair activities must be timestamped
5. The system must track the total repair cost for each vehicle
6. A car can only move to Phase 3 when marked as "repair completed"

### Phase 3: Dealership and Sale
1. Listing date at the dealership must be recorded
2. Asking price must be documented
3. The system must track how long the car remains at the dealership
4. Final selling price must be recorded
5. Sale date must be timestamped
6. A car is considered to have completed its investment cycle once marked as "sold"

## Financial Rules
1. Total investment is calculated as: Purchase Price + Parts Costs + Labor Costs + Painting Costs
2. Profit/Loss is calculated as: Selling Price - Total Investment
3. ROI is calculated as: (Profit/Loss ÷ Total Investment) × 100
4. Each cost entry must be categorized appropriately (purchase, parts, labor, painting)
5. The system must maintain a running total of investment for each car

## Reporting Rules
1. The system must provide profitability analysis for each completed car investment
2. Reports must be filterable by make, model, year, and profitability
3. The system must calculate average repair time, dealership time, and total investment cycle time
4. The system must identify the most profitable car types based on historical data
5. The system must flag cars that exceed predefined thresholds for:
   - Repair costs exceeding X% of purchase price
   - Time at dealership exceeding X days
   - Total investment exceeding estimated market value

## User Access Rules
1. Admin users have full access to all system features
2. Staff users can add/edit car details, parts, and costs but cannot delete records
3. Viewer users can only view reports and car details without editing capabilities
4. All financial data modifications must be logged with user information and timestamp

## Notification Rules
1. The system must notify users when:
   - A car has been in the repair phase for more than X days
   - A car has been at the dealership for more than X days
   - Repair costs exceed the estimated budget by X%
   - A high-profit opportunity is identified (future feature with Python integration)

## Data Retention Rules
1. All car records must be maintained for a minimum of 5 years
2. Images must be stored securely and linked to the appropriate car record
3. Financial records cannot be deleted, only marked as void if necessary
4. All void or modified financial entries must maintain an audit trail

## Future Integration Rules (for Python Microservice)
1. The system must provide API endpoints for the Python service to:
   - Retrieve historical car data for analysis
   - Submit potential buying opportunities
   - Update market value estimates
2. Opportunity scores from the Python service must be displayed prominently in the dashboard
3. Users must be able to set preferences for opportunity notifications
4. The system must track which opportunities were acted upon and their outcomes
