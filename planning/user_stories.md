# I-fixit User Stories

## Overview
This document outlines the user stories for the I-fixit car investment tracking system. User stories are organized by user role to clearly define the functionality required for each type of user.

## Admin User Stories

### System Management
1. As an admin, I want to configure system settings so that I can customize the application to business needs
2. As an admin, I want to manage user accounts so that I can control who has access to the system
3. As an admin, I want to assign roles to users so that I can control their permissions
4. As an admin, I want to view audit logs so that I can track user activities and system changes
5. As an admin, I want to configure notification settings so that users receive appropriate alerts

### Car Management
6. As an admin, I want to add new cars to the system so that I can track their investment cycle
7. As an admin, I want to edit car details so that I can keep information accurate
8. As an admin, I want to delete car records when necessary so that I can maintain data cleanliness
9. As an admin, I want to override phase transitions so that I can handle exceptional cases

### Financial Management
10. As an admin, I want to view financial reports across all cars so that I can assess business performance
11. As an admin, I want to export financial data so that I can use it in external accounting systems
12. As an admin, I want to set profit targets so that I can guide purchasing decisions

### Integration Management
13. As an admin, I want to configure the Python microservice integration so that I can optimize opportunity identification
14. As an admin, I want to manage API access so that I can control external system interactions
15. As an admin, I want to monitor system performance so that I can ensure optimal operation

## Manager User Stories

### Business Management
1. As a manager, I want to view dashboards showing overall business performance so that I can track profitability
2. As a manager, I want to approve high-value purchases so that I can control major investments
3. As a manager, I want to review and analyze reports so that I can identify trends and opportunities
4. As a manager, I want to manage staff accounts so that I can assign appropriate access levels
5. As a manager, I want to set profit targets so that I can guide purchasing decisions

### Car Management
6. As a manager, I want to add new cars to the system so that I can track their investment cycle
7. As a manager, I want to edit car details so that I can keep information accurate
8. As a manager, I want to view cars in all phases so that I can monitor progress
9. As a manager, I want to receive notifications about cars exceeding budget so that I can take action

### Financial Management
10. As a manager, I want to view financial reports so that I can assess business performance
11. As a manager, I want to analyze profitability by car make/model so that I can make better purchasing decisions
12. As a manager, I want to track ROI across different car types so that I can optimize investment strategy

## Dealership Staff User Stories

### Sales Management
1. As dealership staff, I want to view cars in the dealership phase so that I can manage the sales process
2. As dealership staff, I want to update car status when sold so that I can track inventory accurately
3. As dealership staff, I want to record selling prices so that I can calculate final profitability
4. As dealership staff, I want to add notes about potential buyers so that I can track customer interest
5. As dealership staff, I want to upload images of cars at the dealership so that I can document their condition

### Notification Management
6. As dealership staff, I want to receive notifications about cars staying too long at the dealership so that I can adjust pricing
7. As dealership staff, I want to mark notifications as read so that I can manage my workflow
8. As dealership staff, I want to set notification preferences so that I receive relevant alerts

### Reporting
9. As dealership staff, I want to view sales reports so that I can track my performance
10. As dealership staff, I want to see historical sales data so that I can identify trends
11. As dealership staff, I want to export sales reports so that I can share them with management

## Repair Staff User Stories

### Repair Management
1. As repair staff, I want to update car repair status so that I can track progress
2. As repair staff, I want to add parts and labor costs so that I can maintain accurate investment records
3. As repair staff, I want to upload photos of repairs so that I can document the process
4. As repair staff, I want to mark a car as repair-complete so that it can move to the dealership phase
5. As repair staff, I want to view repair history of similar cars so that I can estimate costs more accurately

### Parts Management
6. As repair staff, I want to add parts to a car's repair record so that I can track what was replaced
7. As repair staff, I want to search for suppliers by part so that I can find the best prices
8. As repair staff, I want to track parts inventory so that I know what's available
9. As repair staff, I want to request parts from suppliers so that I can complete repairs

### Reporting
10. As repair staff, I want to view repair cost reports so that I can track expenses
11. As repair staff, I want to analyze repair time by car type so that I can improve efficiency
12. As repair staff, I want to identify common repair issues by make/model so that I can anticipate problems

## Parts Supplier User Stories

### Inventory Management
1. As a parts supplier, I want to view parts orders so that I can fulfill requests
2. As a parts supplier, I want to update parts availability so that repair staff can plan accordingly
3. As a parts supplier, I want to add new parts to the catalog so that they can be ordered
4. As a parts supplier, I want to view parts usage history so that I can manage inventory better
5. As a parts supplier, I want to receive notifications about new parts needs so that I can respond quickly

### Supplier Portal
6. As a parts supplier, I want to update my contact information so that clients can reach me
7. As a parts supplier, I want to view my supply history so that I can track my business
8. As a parts supplier, I want to offer special pricing for bulk orders so that I can increase sales
9. As a parts supplier, I want to mark parts as discontinued so that they're no longer ordered

### Reporting
10. As a parts supplier, I want to view reports on parts I've supplied so that I can track my business
11. As a parts supplier, I want to see which car makes/models use my parts most so that I can optimize inventory
12. As a parts supplier, I want to export supply history so that I can use it in my accounting system

## Viewer User Stories

### Viewing Capabilities
1. As a viewer, I want to view car details without editing capabilities so that I can stay informed
2. As a viewer, I want to access specific reports so that I can analyze business performance
3. As a viewer, I want to see investment summaries so that I can understand profitability
4. As a viewer, I want to view historical data so that I can identify trends
5. As a viewer, I want to filter cars by various criteria so that I can focus on relevant information

### Reporting
6. As a viewer, I want to export reports so that I can use them in other applications
7. As a viewer, I want to save report configurations so that I can quickly access common views
8. As a viewer, I want to schedule regular report generation so that I can receive updates automatically

## Future: Opportunity Analyst User Stories

### Opportunity Management
1. As an opportunity analyst, I want to view potential buying opportunities so that I can evaluate them
2. As an opportunity analyst, I want to score opportunities based on historical data so that I can prioritize them
3. As an opportunity analyst, I want to track auction prices so that I can identify trends
4. As an opportunity analyst, I want to receive alerts about high-scoring opportunities so that I can act quickly
5. As an opportunity analyst, I want to analyze market trends so that I can predict profitable purchases

### Integration with Python Microservice
6. As an opportunity analyst, I want to configure scraping parameters so that I can focus on relevant listings
7. As an opportunity analyst, I want to train the prediction model so that it becomes more accurate
8. As an opportunity analyst, I want to view scraping logs so that I can troubleshoot issues
9. As an opportunity analyst, I want to manually trigger scraping so that I can get immediate results

## Implementation Priority

The user stories will be implemented in the following priority order:

### Phase 1: Core Functionality
- Admin: System Management (1-5)
- Admin: Car Management (6-9)
- Manager: Car Management (6-9)
- Repair Staff: Repair Management (1-5)
- Dealership Staff: Sales Management (1-5)

### Phase 2: Financial and Reporting
- Admin: Financial Management (10-12)
- Manager: Business Management (1-5)
- Manager: Financial Management (10-12)
- Repair Staff: Reporting (10-12)
- Dealership Staff: Reporting (9-11)

### Phase 3: Parts and Suppliers
- Repair Staff: Parts Management (6-9)
- Parts Supplier: Inventory Management (1-5)
- Parts Supplier: Supplier Portal (6-9)
- Parts Supplier: Reporting (10-12)

### Phase 4: Advanced Features and Integration
- Admin: Integration Management (13-15)
- Viewer: All stories (1-8)
- Opportunity Analyst: All stories (future phase)
