# I-fixit User Interface Design

## Overview
This document outlines the user interface design for the I-fixit car investment tracking system. The UI is designed to be intuitive, responsive, and focused on providing clear insights into car investments.

## Design Principles
1. **Clarity**: Present information in a clear, organized manner
2. **Efficiency**: Minimize clicks for common tasks
3. **Consistency**: Maintain consistent design patterns throughout
4. **Responsiveness**: Ensure usability across devices
5. **Data Visualization**: Use charts and graphs for better insights

## Color Scheme
- **Primary Color**: #10B981 (Green)
- **Secondary Color**:rgb(59, 171, 246) (Blue)
- **Accent Color**: #F59E0B (Amber)
- **Danger Color**: #EF4444 (Red)
- **Background Color**: #F9FAFB (Light Gray)
- **Text Color**: #1F2937 (Dark Gray)

## Typography
- **Headings**: Inter, sans-serif
- **Body Text**: Inter, sans-serif
- **Monospace**: Consolas, monospace (for code or technical details)

## Key Screens

### 1. Dashboard
The main landing page after login, providing an overview of the car investment portfolio.

#### Components:
- **Header**: Logo, navigation, user profile, notifications
- **Summary Cards**: Total cars, cars in each phase, total investment, total profit
- **Phase Distribution Chart**: Visual representation of cars in each phase
- **Recent Activity**: Latest updates to cars in the system
- **Profit/Loss Chart**: Monthly or quarterly profit/loss visualization
- **Quick Actions**: Add new car, record sale, view reports

#### Mockup:
```
+-----------------------------------------------------------------------+
|  LOGO   | Dashboard | Cars | Parts | Reports | Admin |  User ▼  🔔   |
+-----------------------------------------------------------------------+
|                                                                       |
|  DASHBOARD                                                            |
|                                                                       |
|  +----------+  +----------+  +----------+  +----------+               |
|  | Total    |  | Fixing   |  | At       |  | Total    |               |
|  | Cars     |  | Phase    |  | Dealer   |  | Profit   |               |
|  | 24       |  | 8        |  | 5        |  | R120,500 |               |
|  +----------+  +----------+  +----------+  +----------+               |
|                                                                       |
|  +-----------------------+  +--------------------------------+        |
|  | Phase Distribution    |  | Monthly Profit/Loss            |        |
|  |                       |  |                                |        |
|  | [PIE CHART]           |  | [BAR CHART]                    |        |
|  |                       |  |                                |        |
|  +-----------------------+  +--------------------------------+        |
|                                                                       |
|  +------------------------------------------------------------------+ |
|  | Recent Activity                                                   | |
|  | • Toyota Corolla (2018) moved to Dealership phase - 2h ago        | |
|  | • Honda Civic (2019) - New part added: Front Bumper - 5h ago      | |
|  | • BMW 3 Series (2017) - Sold for R280,000 - 1d ago                | |
|  | • Volkswagen Golf (2020) - New car added - 2d ago                 | |
|  +------------------------------------------------------------------+ |
|                                                                       |
|  +---------------------------+  +---------------------------+         |
|  | Top Performing Models     |  | Quick Actions             |         |
|  | 1. Toyota Corolla (25%)   |  | [Add New Car]             |         |
|  | 2. Honda Civic (18%)      |  | [Record Sale]             |         |
|  | 3. VW Golf (15%)          |  | [View Reports]            |         |
|  +---------------------------+  +---------------------------+         |
|                                                                       |
+-----------------------------------------------------------------------+
```

### 2. Car Listing
A page displaying all cars in the system with filtering and sorting options.

#### Components:
- **Search Bar**: Search by make, model, year, etc.
- **Filters**: Filter by phase, make, model, year, profitability
- **Sorting Options**: Sort by date added, purchase price, profit, etc.
- **Car Cards/Table**: Display of cars with key information
- **Pagination**: Navigate through multiple pages of results
- **Action Buttons**: View details, edit, delete

#### Mockup:
```
+-----------------------------------------------------------------------+
|  LOGO   | Dashboard | Cars | Parts | Reports | Admin |  User ▼  🔔   |
+-----------------------------------------------------------------------+
|                                                                       |
|  CARS                                                   [+ Add Car]   |
|                                                                       |
|  +------------------------------------------------------------------+ |
|  | Search: [                                        ]                | |
|  |                                                                   | |
|  | Filter by: Phase ▼  Make ▼  Year ▼  Profit ▼    Sort by: Date ▼  | |
|  +------------------------------------------------------------------+ |
|                                                                       |
|  +------------------------------------------------------------------+ |
|  | ✓ | Make/Model       | Year | Phase      | Investment | Profit   | |
|  |---+------------------+------+------------+------------+----------| |
|  | □ | Toyota Corolla   | 2018 | Dealership | R150,000   | Pending  | |
|  | □ | Honda Civic      | 2019 | Fixing     | R120,000   | Pending  | |
|  | □ | BMW 3 Series     | 2017 | Sold       | R200,000   | R45,000  | |
|  | □ | VW Golf          | 2020 | Fixing     | R180,000   | Pending  | |
|  | □ | Ford Focus       | 2016 | Sold       | R110,000   | R28,000  | |
|  | □ | Hyundai i20      | 2019 | Bidding    | R90,000    | Pending  | |
|  | □ | Kia Rio          | 2018 | Fixing     | R105,000   | Pending  | |
|  | □ | Nissan Qashqai   | 2017 | Dealership | R160,000   | Pending  | |
|  |                                                                   | |
|  | [Previous]                                             [Next]     | |
|  +------------------------------------------------------------------+ |
|                                                                       |
|  Selected: [View Details] [Edit] [Delete]                             |
|                                                                       |
+-----------------------------------------------------------------------+
```

### 3. Car Details
A detailed view of a specific car with all related information.

#### Components:
- **Car Information**: Make, model, year, VIN, etc.
- **Phase Timeline**: Visual representation of the car's journey
- **Image Gallery**: Before, during, and after repair photos
- **Tabs**: Details, Parts, Labor, Painting, Sales, Documents
- **Financial Summary**: Investment breakdown and profit calculation
- **Action Buttons**: Edit, move to next phase, add parts, etc.

#### Mockup:
```
+-----------------------------------------------------------------------+
|  LOGO   | Dashboard | Cars | Parts | Reports | Admin |  User ▼  🔔   |
+-----------------------------------------------------------------------+
|                                                                       |
|  CAR DETAILS: Toyota Corolla (2018)                                   |
|                                                                       |
|  +---------------------------+  +----------------------------------+  |
|  | [IMAGE GALLERY]           |  | Current Phase: Dealership           |
|  |                           |  | Purchase Date: 2023-01-15           |
|  |                           |  | Days in Current Phase: 45           |
|  |                           |  | Total Investment: R150,000          |
|  |                           |  | Estimated Profit: R35,000           |
|  |                           |  |                                     |
|  |                           |  | [Edit] [Move to Sold] [Print]       |
|  +---------------------------+  +----------------------------------+  |
|                                                                       |
|  +------------------------------------------------------------------+ |
|  | Phase Timeline                                                    | |
|  | [Bidding]---->[Fixing]---->[Dealership]---->[Sold]                | |
|  | 2023-01-15    2023-02-10   2023-03-20      Pending                | |
|  +------------------------------------------------------------------+ |
|                                                                       |
|  | Details | Parts | Labor | Painting | Sales | Documents |           |
|  +------------------------------------------------------------------+ |
|  | Make: Toyota                  | Model: Corolla                    | |
|  | Year: 2018                    | VIN: ABC123XYZ456                 | |
|  | Registration: CA123456        | Color: Silver                     | |
|  | Body Type: Sedan              | Engine: 1.8L                      | |
|  | Fuel Type: Petrol             | Transmission: Automatic           | |
|  | Mileage: 85,000 km            | Features: Sunroof, Leather seats  | |
|  |                                                                   | |
|  | Purchase Details:                                                 | |
|  | Purchase Price: R90,000       | Auction House: ABC Auctions       | |
|  | Auction Lot: LOT123           | Purchase Date: 2023-01-15         | |
|  |                                                                   | |
|  | Damage Description:                                               | |
|  | Front-end collision with moderate damage to bumper, radiator,     | |
|  | and hood. Minor damage to left headlight assembly.                | |
|  +------------------------------------------------------------------+ |
|                                                                       |
|  +---------------------------+  +----------------------------------+  |
|  | Investment Breakdown      |  | Notes                               |
|  | Purchase: R90,000         |  | Car has been at the dealership      |
|  | Parts: R35,000            |  | for 45 days. Several interested     |
|  | Labor: R20,000            |  | buyers but no firm offers yet.      |
|  | Painting: R5,000          |  | Consider reducing price if not      |
|  | Total: R150,000           |  | sold within 60 days.                |
|  +---------------------------+  +----------------------------------+  |
|                                                                       |
+-----------------------------------------------------------------------+
```

### 4. Add/Edit Car
Form for adding a new car or editing an existing one.

#### Components:
- **Form Sections**: Basic info, purchase details, condition, features
- **Image Upload**: Multiple image upload with preview
- **Validation**: Real-time form validation
- **Save/Cancel Buttons**: Submit or cancel the form

#### Mockup:
```
+-----------------------------------------------------------------------+
|  LOGO   | Dashboard | Cars | Parts | Reports | Admin |  User ▼  🔔   |
+-----------------------------------------------------------------------+
|                                                                       |
|  ADD NEW CAR                                                          |
|                                                                       |
|  +------------------------------------------------------------------+ |
|  | Basic Information                                                 | |
|  | Make: [                ] Model: [                ]                | |
|  | Year: [      ]           VIN: [                ]                  | |
|  | Registration: [        ]  Color: [                ]               | |
|  | Body Type: [Dropdown ▼]   Engine Size: [        ]                 | |
|  | Fuel Type: [Dropdown ▼]   Transmission: [Dropdown ▼]              | |
|  | Mileage: [         ] km                                           | |
|  +------------------------------------------------------------------+ |
|                                                                       |
|  +------------------------------------------------------------------+ |
|  | Purchase Details                                                  | |
|  | Purchase Date: [Date Picker]   Purchase Price: R [         ]      | |
|  | Auction House: [             ] Auction Lot #: [        ]          | |
|  +------------------------------------------------------------------+ |
|                                                                       |
|  +------------------------------------------------------------------+ |
|  | Condition                                                         | |
|  | Damage Description:                                               | |
|  | [                                                               ] | |
|  | [                                                               ] | |
|  | Damage Severity: [Light ▼]    Operational: [Yes ▼]                | |
|  +------------------------------------------------------------------+ |
|                                                                       |
|  +------------------------------------------------------------------+ |
|  | Features                                                          | |
|  | □ Sunroof  □ Leather Seats  □ Navigation  □ Backup Camera        | |
|  | □ Bluetooth  □ Custom Rims  □ Custom Sound System  □ Other        | |
|  | Other Features: [                                               ] | |
|  +------------------------------------------------------------------+ |
|                                                                       |
|  +------------------------------------------------------------------+ |
|  | Images                                                            | |
|  | [Choose Files] or drag and drop                                   | |
|  | [Preview of uploaded images]                                      | |
|  +------------------------------------------------------------------+ |
|                                                                       |
|  [Cancel]                                                  [Save Car] |
|                                                                       |
+-----------------------------------------------------------------------+
```

### 5. Parts Management
Page for adding and managing parts for a specific car.

#### Components:
- **Car Selection**: Select car to add parts to
- **Parts List**: Table of parts already added
- **Add Part Form**: Form to add a new part
- **Supplier Selection**: Choose from existing suppliers or add new
- **Cost Summary**: Running total of parts costs

#### Mockup:
```
+-----------------------------------------------------------------------+
|  LOGO   | Dashboard | Cars | Parts | Reports | Admin |  User ▼  🔔   |
+-----------------------------------------------------------------------+
|                                                                       |
|  PARTS MANAGEMENT: Toyota Corolla (2018)                [+ Add Part]  |
|                                                                       |
|  +------------------------------------------------------------------+ |
|  | Parts List                                                        | |
|  | ✓ | Part Name      | Supplier    | Date       | Cost     | Status | |
|  |---+----------------+-------------+------------+----------+--------| |
|  | □ | Front Bumper   | ABC Parts   | 2023-02-12 | R8,500   | Installed |
|  | □ | Radiator       | XYZ Auto    | 2023-02-15 | R4,200   | Installed |
|  | □ | Hood           | ABC Parts   | 2023-02-18 | R6,800   | Installed |
|  | □ | Headlight (L)  | LightCo     | 2023-02-20 | R3,500   | Installed |
|  | □ | Paint - Silver | ColorMaster | 2023-03-05 | R5,000   | Completed |
|  |                                                                   | |
|  | Total Parts Cost: R28,000                                         | |
|  +------------------------------------------------------------------+ |
|                                                                       |
|  +------------------------------------------------------------------+ |
|  | Add New Part                                                      | |
|  | Part Name: [                ]  Description: [                   ] | |
|  | Condition: [New ▼]            Quantity: [  ]                      | |
|  | Unit Price: R [         ]     Total Price: R [         ]          | |
|  | Purchase Date: [Date Picker]  Installation Date: [Date Picker]    | |
|  |                                                                   | |
|  | Supplier: [Select Supplier ▼] or [+ Add New Supplier]             | |
|  |                                                                   | |
|  | [Cancel]                                              [Add Part]  | |
|  +------------------------------------------------------------------+ |
|                                                                       |
|  Selected: [Edit] [Delete]                                            |
|                                                                       |
+-----------------------------------------------------------------------+
```

### 6. Reports
Page for generating and viewing various reports.

#### Components:
- **Report Types**: Selection of different report types
- **Filters**: Date range, car make/model, etc.
- **Data Visualization**: Charts and graphs
- **Data Table**: Tabular data with sorting
- **Export Options**: PDF, CSV, Excel

#### Mockup:
```
+-----------------------------------------------------------------------+
|  LOGO   | Dashboard | Cars | Parts | Reports | Admin |  User ▼  🔔   |
+-----------------------------------------------------------------------+
|                                                                       |
|  REPORTS                                                              |
|                                                                       |
|  +------------------------------------------------------------------+ |
|  | Report Type: [Profitability Analysis ▼]                           | |
|  |                                                                   | |
|  | Date Range: [Jan 2023 ▼] to [Apr 2023 ▼]                          | |
|  | Make: [All ▼]  Model: [All ▼]  Year: [All ▼]                      | |
|  |                                                                   | |
|  | [Generate Report]                         [Export: PDF ▼]          | |
|  +------------------------------------------------------------------+ |
|                                                                       |
|  +------------------------------------------------------------------+ |
|  | Profitability Analysis                                            | |
|  |                                                                   | |
|  | [BAR CHART: Profit by Make]                                       | |
|  |                                                                   | |
|  +------------------------------------------------------------------+ |
|                                                                       |
|  +------------------------------------------------------------------+ |
|  | Make     | # Cars | Avg Purchase | Avg Repair | Avg Sale | Avg ROI | |
|  |----------+--------+-------------+-----------+----------+---------| |
|  | Toyota   | 5      | R95,000     | R45,000   | R165,000 | 18%     | |
|  | Honda    | 3      | R88,000     | R52,000   | R158,000 | 13%     | |
|  | BMW      | 2      | R180,000    | R75,000   | R285,000 | 12%     | |
|  | VW       | 4      | R105,000    | R48,000   | R175,000 | 15%     | |
|  | Ford     | 3      | R92,000     | R42,000   | R155,000 | 16%     | |
|  |                                                                   | |
|  | Overall  | 17     | R102,000    | R49,000   | R172,000 | 15%     | |
|  +------------------------------------------------------------------+ |
|                                                                       |
|  +------------------------------------------------------------------+ |
|  | Insights                                                          | |
|  | • Toyota vehicles show the highest average ROI at 18%             | |
|  | • Sedans outperform SUVs in terms of ROI (17% vs 13%)             | |
|  | • Average time to sell: 32 days                                   | |
|  | • Most profitable model: Toyota Corolla (22% average ROI)         | |
|  +------------------------------------------------------------------+ |
|                                                                       |
+-----------------------------------------------------------------------+
```

### 7. Future: Opportunities Dashboard
Page for viewing potential buying opportunities identified by the Python microservice.

#### Components:
- **Opportunity Cards**: Visual cards for each opportunity
- **Filters**: Filter by score, make, model, etc.
- **Opportunity Details**: Estimated costs, profit, and score
- **Action Buttons**: Mark as interested, ignore, etc.

#### Mockup:
```
+-----------------------------------------------------------------------+
|  LOGO   | Dashboard | Cars | Parts | Reports | Opportunities |  User ▼ |
+-----------------------------------------------------------------------+
|                                                                       |
|  OPPORTUNITIES                                                        |
|                                                                       |
|  +------------------------------------------------------------------+ |
|  | Filter by: Score ▼  Make ▼  Profit ▼    Sort by: Score ▼          | |
|  +------------------------------------------------------------------+ |
|                                                                       |
|  +-------------------------+  +-------------------------+             |
|  | Toyota Corolla (2019)   |  | Honda Civic (2020)     |             |
|  | Score: 85/100           |  | Score: 78/100          |             |
|  | [IMAGE]                 |  | [IMAGE]                |             |
|  |                         |  |                        |             |
|  | Auction: SMD            |  | Auction: AuctionNation |             |
|  | Current Bid: R65,000    |  | Current Bid: R72,000   |             |
|  | Est. Repair: R35,000    |  | Est. Repair: R40,000   |             |
|  | Est. Value: R145,000    |  | Est. Value: R155,000   |             |
|  | Potential Profit: R45,000|  | Potential Profit: R43,000|          |
|  |                         |  |                        |             |
|  | Ends in: 2 days         |  | Ends in: 5 hours       |             |
|  |                         |  |                        |             |
|  | [View Details] [Interested]|  | [View Details] [Interested]|      |
|  +-------------------------+  +-------------------------+             |
|                                                                       |
|  +-------------------------+  +-------------------------+             |
|  | BMW 3 Series (2018)     |  | VW Golf (2019)         |             |
|  | Score: 72/100           |  | Score: 68/100          |             |
|  | [IMAGE]                 |  | [IMAGE]                |             |
|  |                         |  |                        |             |
|  | Auction: GoBid          |  | Auction: SMD           |             |
|  | Current Bid: R120,000   |  | Current Bid: R85,000   |             |
|  | Est. Repair: R55,000    |  | Est. Repair: R38,000   |             |
|  | Est. Value: R220,000    |  | Est. Value: R155,000   |             |
|  | Potential Profit: R45,000|  | Potential Profit: R32,000|          |
|  |                         |  |                        |             |
|  | Ends in: 1 day          |  | Ends in: 3 days        |             |
|  |                         |  |                        |             |
|  | [View Details] [Interested]|  | [View Details] [Interested]|      |
|  +-------------------------+  +-------------------------+             |
|                                                                       |
+-----------------------------------------------------------------------+
```

## Responsive Design
The UI will be responsive and adapt to different screen sizes:

### Desktop (1200px+)
- Full layout as shown in mockups
- Multi-column dashboard
- Sidebar navigation

### Tablet (768px - 1199px)
- Condensed navigation
- Two-column layout for dashboard
- Stacked cards on some screens

### Mobile (< 768px)
- Hamburger menu for navigation
- Single column layout
- Simplified tables with horizontal scrolling
- Focused content with less visible at once

## UI Components

### Navigation
- **Top Bar**: Logo, main navigation, user profile, notifications
- **Breadcrumbs**: Show current location in the application
- **Sidebar**: On larger screens for secondary navigation

### Cards
- Used for summarizing information
- Consistent padding and border radius
- Optional header with title and actions
- Support for various content types (text, charts, tables)

### Tables
- Consistent styling for data tables
- Sortable columns
- Row selection
- Pagination
- Responsive behavior (horizontal scroll on small screens)

### Forms
- Clear labels
- Consistent input styling
- Inline validation
- Grouped fields for logical sections
- Responsive layout

### Buttons
- Primary: Blue (#3B82F6)
- Secondary: Gray (#6B7280)
- Success: Green (#10B981)
- Danger: Red (#EF4444)
- Consistent padding and border radius
- Icon support

### Charts and Graphs
- Consistent styling and colors
- Interactive tooltips
- Responsive sizing
- Clear labels and legends

## Accessibility Considerations
- Sufficient color contrast
- Keyboard navigation support
- Screen reader compatibility
- Focus indicators
- Alternative text for images
- Semantic HTML structure

## Implementation Notes
- Use Tailwind CSS for styling
- Implement with Laravel Blade and Livewire components
- Use Alpine.js for interactive elements
- Ensure responsive design works across devices
- Implement progressive enhancement for better performance
