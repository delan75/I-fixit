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

### 7. Advanced Analytics Dashboard
Page for viewing comprehensive analytics and predictive insights.

#### Components:
- **Dashboard Widgets**: Customizable analytics widgets
- **Profit Trends**: Visual representation of profit trends over time
- **Predictive Models**: Optimal selling time predictions
- **Repair Cost Benchmarking**: Comparison against industry standards
- **ROI Comparison**: Analysis across different makes/models/years
- **Export Options**: Export data in multiple formats

#### Mockup:
```
+-----------------------------------------------------------------------+
|  LOGO   | Dashboard | Cars | Parts | Reports | Analytics |  User ▼  🔔 |
+-----------------------------------------------------------------------+
|                                                                       |
|  ANALYTICS DASHBOARD                                [Customize] [Export] |
|                                                                       |
|  +---------------------------+  +----------------------------------+  |
|  | Profit Trends             |  | Optimal Selling Time Predictions |  |
|  |                           |  |                                  |  |
|  | [LINE CHART: Monthly      |  | [HEAT MAP: Best months to sell   |  |
|  |  profit over time]        |  |  by make/model]                  |  |
|  |                           |  |                                  |  |
|  | • Q1 2023: R120,500       |  | Toyota Corolla: June-August      |  |
|  | • Q2 2023: R145,200       |  | Honda Civic: March-May           |  |
|  | • Q3 2023: R180,800       |  | BMW 3 Series: September-November |  |
|  |                           |  |                                  |  |
|  | [View Details]            |  | Confidence Score: 85%            |  |
|  +---------------------------+  +----------------------------------+  |
|                                                                       |
|  +---------------------------+  +----------------------------------+  |
|  | Repair Cost Benchmarking  |  | ROI Comparison by Make/Model     |  |
|  |                           |  |                                  |  |
|  | [BAR CHART: Your costs vs |  | [SCATTER PLOT: ROI vs Investment]|  |
|  |  industry average]        |  |                                  |  |
|  |                           |  |                                  |  |
|  | • Parts: 5% below avg     |  | Top Performers:                  |  |
|  | • Labor: 2% above avg     |  | 1. Toyota Corolla (25% ROI)      |  |
|  | • Painting: 8% below avg  |  | 2. Honda Civic (22% ROI)         |  |
|  |                           |  | 3. VW Golf (19% ROI)             |  |
|  | [View Details]            |  | [View Details]                   |  |
|  +---------------------------+  +----------------------------------+  |
|                                                                       |
|  +------------------------------------------------------------------+ |
|  | Historical Performance                                            | |
|  |                                                                   | |
|  | [TABLE: Performance metrics for completed investments]            | |
|  | Make/Model | Purchase | Repair | Sale | Profit | ROI | Days to Sell |
|  | Toyota Corolla | R90,000 | R35,000 | R165,000 | R40,000 | 32% | 28 |
|  | Honda Civic | R85,000 | R42,000 | R158,000 | R31,000 | 24% | 35 |
|  | BMW 3 Series | R180,000 | R65,000 | R285,000 | R40,000 | 16% | 42 |
|  |                                                                   | |
|  | [View All Historical Data]                                        | |
|  +------------------------------------------------------------------+ |
|                                                                       |
+-----------------------------------------------------------------------+
```

### 8. Supplier Marketplace
Page for browsing and ordering parts from suppliers.

#### Components:
- **Supplier Directory**: List of available suppliers
- **Parts Catalog**: Searchable catalog of available parts
- **Part Details**: Detailed information about each part
- **Order Management**: Interface for placing and tracking orders
- **Supplier Ratings**: Reviews and ratings for suppliers

#### Mockup:
```
+-----------------------------------------------------------------------+
|  LOGO   | Dashboard | Cars | Parts | Marketplace | Reports |  User ▼  🔔 |
+-----------------------------------------------------------------------+
|                                                                       |
|  SUPPLIER MARKETPLACE                                  [My Orders]    |
|                                                                       |
|  +---------------------------+  +----------------------------------+  |
|  | Suppliers                 |  | Parts Catalog                    |  |
|  |                           |  |                                  |  |
|  | [Search Suppliers]        |  | [Search Parts]                   |  |
|  |                           |  |                                  |  |
|  | • Toyota Parts Center ★★★★☆|  | Filter by: Compatibility ▼ Price ▼ |
|  | • ABC Auto Parts ★★★★★    |  | Condition ▼ Supplier ▼           |  |
|  | • XYZ Spares ★★★☆☆        |  |                                  |  |
|  | • Premium Auto ★★★★☆      |  | [Grid of part listings with      |  |
|  | • Budget Parts ★★★☆☆      |  |  images, prices, and ratings]    |  |
|  |                           |  |                                  |  |
|  | [View All Suppliers]      |  | [View More Parts]                |  |
|  +---------------------------+  +----------------------------------+  |
|                                                                       |
|  +------------------------------------------------------------------+ |
|  | Featured Part                                                     | |
|  |                                                                   | |
|  | [IMAGE: Toyota Genuine Front Bumper]                              | |
|  |                                                                   | |
|  | Toyota Genuine Front Bumper                                       | |
|  | Supplier: Toyota Parts Center                                     | |
|  | Condition: New                                                    | |
|  | Price: R8,500                                                     | |
|  | Compatible with: Toyota Corolla (2015-2020), Toyota Auris (2016-2019) |
|  | Rating: ★★★★★ (24 reviews)                                        | |
|  |                                                                   | |
|  | [Add to Cart]                                                     | |
|  +------------------------------------------------------------------+ |
|                                                                       |
|  +---------------------------+  +----------------------------------+  |
|  | Current Orders            |  | Recent Activity                  |  |
|  |                           |  |                                  |  |
|  | Order #12345              |  | • You ordered Front Bumper       |  |
|  | Status: Shipped           |  |   2 days ago                     |  |
|  | ETA: May 15, 2023         |  | • You reviewed ABC Auto Parts    |  |
|  |                           |  |   1 week ago                     |  |
|  | Order #12346              |  | • New supplier joined: Premium   |  |
|  | Status: Processing        |  |   Auto Parts - 2 weeks ago       |  |
|  |                           |  |                                  |  |
|  | [View All Orders]         |  | [View All Activity]              |  |
|  +---------------------------+  +----------------------------------+  |
|                                                                       |
+-----------------------------------------------------------------------+
```

### 9. Public Car Listings
Public-facing page for browsing cars in the dealership phase.

#### Components:
- **Search Interface**: Advanced search functionality
- **Car Listings**: Grid or list view of available cars
- **Car Details**: Detailed information about each car
- **Inquiry Form**: Form for potential buyers to contact sellers
- **Featured Listings**: Highlighted car listings

#### Mockup:
```
+-----------------------------------------------------------------------+
|  LOGO   | Home | Cars | About | Contact |             [Login]         |
+-----------------------------------------------------------------------+
|                                                                       |
|  FIND YOUR PERFECT CAR                                                |
|                                                                       |
|  +------------------------------------------------------------------+ |
|  | [Search: Make, Model, Year, etc.]                                | |
|  |                                                                   | |
|  | Make: [All ▼]  Model: [All ▼]  Year: [All ▼]  Price: [Any ▼]      | |
|  | Body Type: [All ▼]  Fuel: [All ▼]  Transmission: [All ▼]          | |
|  |                                                                   | |
|  | [Advanced Search]                               [Search]          | |
|  +------------------------------------------------------------------+ |
|                                                                       |
|  FEATURED LISTINGS                                                    |
|                                                                       |
|  +-------------------------+  +-------------------------+             |
|  | [IMAGE: Toyota Corolla] |  | [IMAGE: Honda Civic]    |             |
|  |                         |  |                         |             |
|  | Toyota Corolla 1.8      |  | Honda Civic 1.5T        |             |
|  | 2018 • 85,000 km        |  | 2019 • 65,000 km        |             |
|  | Automatic • Petrol      |  | Automatic • Petrol      |             |
|  |                         |  |                         |             |
|  | Price: R165,000         |  | Price: R185,000         |             |
|  |                         |  |                         |             |
|  | [View Details]          |  | [View Details]          |             |
|  +-------------------------+  +-------------------------+             |
|                                                                       |
|  +-------------------------+  +-------------------------+             |
|  | [IMAGE: BMW 3 Series]   |  | [IMAGE: VW Golf]        |             |
|  |                         |  |                         |             |
|  | BMW 3 Series 320i       |  | VW Golf 1.4 TSI         |             |
|  | 2017 • 95,000 km        |  | 2020 • 45,000 km        |             |
|  | Automatic • Petrol      |  | Automatic • Petrol      |             |
|  |                         |  |                         |             |
|  | Price: R285,000         |  | Price: R225,000         |             |
|  |                         |  |                         |             |
|  | [View Details]          |  | [View Details]          |             |
|  +-------------------------+  +-------------------------+             |
|                                                                       |
|  [View All Cars]                                                      |
|                                                                       |
+-----------------------------------------------------------------------+
```

### 10. Auction Integration
Page for managing auction listings and bids.

#### Components:
- **Auction Listings**: List of available auction listings
- **Bid Management**: Interface for placing and tracking bids
- **Opportunity Scoring**: Visual representation of opportunity scores
- **Auction History**: Record of past auction activities
- **Filters**: Filter by auction platform, score, etc.

#### Mockup:
```
+-----------------------------------------------------------------------+
|  LOGO   | Dashboard | Cars | Auctions | Reports | Admin |  User ▼  🔔 |
+-----------------------------------------------------------------------+
|                                                                       |
|  AUCTION INTEGRATION                                 [My Bids]        |
|                                                                       |
|  +------------------------------------------------------------------+ |
|  | Filter by: Platform ▼  Score ▼  Ending ▼    Sort by: Ending ▼     | |
|  +------------------------------------------------------------------+ |
|                                                                       |
|  +---------------------------+  +----------------------------------+  |
|  | Active Auctions           |  | Auction Details: Toyota Corolla  |  |
|  |                           |  |                                  |  |
|  | • Toyota Corolla (2019)   |  | [IMAGE GALLERY]                  |  |
|  |   Score: 85/100           |  |                                  |  |
|  |   Ends in: 2 days         |  | Platform: SMD Auctions           |  |
|  |                           |  | Lot Number: LOT12345             |  |
|  | • Honda Civic (2020)      |  | Current Bid: R65,000             |  |
|  |   Score: 78/100           |  | Your Max Bid: R75,000            |  |
|  |   Ends in: 5 hours        |  | Estimated Repair: R35,000        |  |
|  |                           |  | Estimated Value: R145,000        |  |
|  | • BMW 3 Series (2018)     |  | Potential Profit: R45,000        |  |
|  |   Score: 72/100           |  |                                  |  |
|  |   Ends in: 1 day          |  | Opportunity Score: 85/100        |  |
|  |                           |  | Confidence: High                 |  |
|  | • VW Golf (2019)          |  |                                  |  |
|  |   Score: 68/100           |  | [Place Bid] [Set Max Bid]        |  |
|  |   Ends in: 3 days         |  | [Add to Watchlist]               |  |
|  |                           |  |                                  |  |
|  | [View More]               |  | Auction ends: May 15, 2023 14:30 |  |
|  +---------------------------+  +----------------------------------+  |
|                                                                       |
|  +------------------------------------------------------------------+ |
|  | Auction History                                                   | |
|  |                                                                   | |
|  | [TABLE: Recent auction participation]                             | |
|  | Date       | Platform | Vehicle        | Bid     | Result         | |
|  | 2023-05-01 | SMD      | Toyota Camry   | R70,000 | Won            | |
|  | 2023-04-25 | GoBid    | Honda Accord   | R65,000 | Outbid         | |
|  | 2023-04-18 | AuctionX | Nissan X-Trail | R85,000 | Won            | |
|  |                                                                   | |
|  | Success Rate: 67% (6/9 auctions won)                             | |
|  +------------------------------------------------------------------+ |
|                                                                       |
+-----------------------------------------------------------------------+
```

### 11. Document Generation and E-Signing
Page for generating and managing documents with electronic signatures.

#### Components:
- **Document Templates**: List of available document templates
- **Document Generation**: Interface for creating new documents
- **E-Signature Process**: Workflow for electronic signing
- **Document History**: Record of document versions and changes
- **Document Sharing**: Options for sharing documents

#### Mockup:
```
+-----------------------------------------------------------------------+
|  LOGO   | Dashboard | Cars | Documents | Reports | Admin |  User ▼  🔔 |
+-----------------------------------------------------------------------+
|                                                                       |
|  DOCUMENT MANAGEMENT                              [+ New Document]    |
|                                                                       |
|  +---------------------------+  +----------------------------------+  |
|  | Document Templates        |  | Recent Documents                 |  |
|  |                           |  |                                  |  |
|  | • Sales Contract          |  | • Toyota Corolla - Sales Contract|  |
|  | • Repair Authorization    |  |   Created: May 10, 2023          |  |
|  | • Vehicle Inspection      |  |   Status: Awaiting Signatures    |  |
|  | • Receipt                 |  |                                  |  |
|  | • Invoice                 |  | • Honda Civic - Repair Auth      |  |
|  | • Transfer of Ownership   |  |   Created: May 5, 2023           |  |
|  |                           |  |   Status: Completed              |  |
|  | [Manage Templates]        |  |                                  |  |
|  +---------------------------+  +----------------------------------+  |
|                                                                       |
|  +------------------------------------------------------------------+ |
|  | Document Details: Toyota Corolla - Sales Contract                 | |
|  |                                                                   | |
|  | [DOCUMENT PREVIEW]                                                | |
|  |                                                                   | |
|  | Created: May 10, 2023                                             | |
|  | Created by: John Smith                                            | |
|  | Version: 2.0                                                      | |
|  | Status: Awaiting Signatures                                       | |
|  |                                                                   | |
|  | Signatories:                                                      | |
|  | • John Smith (Seller) - Signed on May 10, 2023                    | |
|  | • Jane Doe (Buyer) - Pending                                      | |
|  |                                                                   | |
|  | [Download PDF] [Send Reminder] [View History] [Void Document]     | |
|  +------------------------------------------------------------------+ |
|                                                                       |
|  +---------------------------+  +----------------------------------+  |
|  | E-Signature Process       |  | Document Analytics               |  |
|  |                           |  |                                  |  |
|  | 1. Create document        |  | Documents created: 45            |  |
|  | 2. Add signatories        |  | Documents completed: 38          |  |
|  | 3. Send for signature     |  | Average completion time: 2.3 days|  |
|  | 4. Track status           |  | Most used template: Sales Contract|  |
|  | 5. Download completed doc |  |                                  |  |
|  |                           |  | [View Detailed Analytics]        |  |
|  | [View Guide]              |  |                                  |  |
|  +---------------------------+  +----------------------------------+  |
|                                                                       |
+-----------------------------------------------------------------------+
```

### 12. Future: Opportunities Dashboard
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
