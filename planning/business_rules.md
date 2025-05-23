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
2. Asking price must be documented based on estimated market value
3. The system must track how long the car remains at the dealership
4. Actual selling price must be recorded (which may differ from estimated market value)
5. Sale date must be timestamped
6. A car is considered to have completed its investment cycle once marked as "sold"
7. The system must support recording sales at a loss (e.g., when a car is sent back to auction)
8. The system must distinguish between estimated market value (for projections) and actual selling price (for final calculations)

## Financial Rules
1. Total investment is calculated as: Purchase Price + Transportation Costs + Parts Costs + Labor Costs + Painting Costs + Other Costs
2. Projected profit/loss is calculated as: Estimated Market Value - Total Investment (for cars not yet sold)
3. Actual profit/loss is calculated as: Actual Selling Price - Total Investment (for sold cars)
4. ROI is calculated as: (Profit/Loss ÷ Total Investment) × 100
5. Each cost entry must be categorized appropriately (purchase, transportation, parts, labor, painting, other)
6. The system must maintain a running total of investment for each car
7. The system must provide both projected and actual financial metrics to guide purchasing decisions

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

## Advanced Analytics Rules
1. The analytics dashboard must provide visual representations of profit trends over time
2. The system must implement predictive models for determining optimal selling times
3. Repair cost benchmarking must compare costs against industry standards and historical data
4. ROI comparison must be available across different makes, models, and years
5. Users must be able to customize their analytics dashboard with relevant widgets
6. Analytics data must be exportable in multiple formats (PDF, Excel, CSV)
7. Historical performance tracking must be available for all completed car investments
8. Predictive models must be regularly updated with new data to maintain accuracy
9. Confidence scores must be displayed for all predictions to indicate reliability

## Supplier Marketplace Rules
1. The marketplace must allow suppliers to register and manage their profiles
2. Suppliers must be able to list parts with detailed information and pricing
3. Users must be able to order parts directly through the system
4. The system must support supplier bidding for competitive pricing
5. Order tracking must be available from placement to delivery
6. Supplier ratings and reviews must be based on verified purchases
7. Volume discounts must be configurable by suppliers
8. The system must provide marketplace analytics for suppliers
9. Parts must be searchable by compatibility with specific car makes, models, and years
10. The system must enforce inventory management to prevent ordering unavailable parts

## Public Car Listing Rules
1. Cars in the "dealership" phase must be automatically listed on the public marketplace
2. Public listings must not reveal repair history or internal investment details
3. The public interface must include advanced search functionality similar to AutoTrader
4. Inquiries from potential buyers must be routed to the appropriate user
5. Public listings must include high-quality images and detailed specifications
6. SEO optimization must be applied to public listings for better visibility
7. View counts and engagement metrics must be tracked for each listing
8. Featured listings must be prominently displayed in search results
9. Contact information must be protected to prevent spam
10. The system must support negotiable and fixed price options

## Auction Integration Rules
1. The system must integrate with major auction platforms via API
2. Auction listings must be automatically imported and categorized
3. Bid management must be available directly from the I-fixit interface
4. Automatic opportunity scoring must be applied to all imported listings
5. The purchase workflow must be streamlined for winning bids
6. Auction history must be tracked for analysis and future reference
7. Users must be able to set maximum bid amounts for auto-bidding
8. The system must provide notifications for outbid situations and auction endings
9. Auction data must be incorporated into analytics and predictive models
10. The system must track success rates for auction purchases

## Document Generation and E-Signing Rules
1. The system must generate standardized documents from templates
2. Sales contracts must include all legally required information
3. Repair authorizations must detail all planned work and estimated costs
4. Electronic signatures must be legally binding and compliant with regulations
5. Document versioning must maintain a history of all changes
6. Document storage must be secure and accessible only to authorized users
7. Compliance verification must ensure all required fields are completed
8. Document sharing must respect user permissions and privacy
9. Templates must be customizable by administrators
10. The system must support multiple signatories for complex documents

## Future Integration Rules (for Python Microservice)
1. The system must provide API endpoints for the Python service to:
   - Retrieve historical car data for analysis
   - Submit potential buying opportunities
   - Update market value estimates
2. Opportunity scores from the Python service must be displayed prominently in the dashboard
3. Users must be able to set preferences for opportunity notifications
4. The system must track which opportunities were acted upon and their outcomes
