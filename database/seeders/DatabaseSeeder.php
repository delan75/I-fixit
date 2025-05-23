<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Car;
use App\Models\CarImage;
use App\Models\DamagedPart;
use App\Models\Document;
use App\Models\Image;
use App\Models\Labor;
use App\Models\Painting;
use App\Models\Part;
use App\Models\Sale;
use App\Models\Supplier;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Arr;

use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // ==============================
        // Create Users
        // ==============================

        // Check if admin user exists, create if not
        $admin = User::where('email', 'admin@example.com')->first();

        if (!$admin) {
            $admin = User::factory()->create([
                'id' => Str::uuid(),
                'first_name' => 'Admin',
                'last_name' => 'User',
                'name' => 'Admin User',
                'email' => 'admin@example.com',
                'phone' => '123-456-7890',
                'role' => 'admin',
                'is_superuser' => false,
                'status' => 'active',
            ]);
        }

        // Create regular users with realistic data (if less than 5 exist)
        $existingUserCount = User::count();
        $usersToCreate = max(0, 5 - $existingUserCount);

        $users = collect([$admin]);
        if ($usersToCreate > 0) {
            $users = $users->merge(User::factory($usersToCreate)->create());
        } else {
            // Add some existing users to the collection
            $users = $users->merge(User::where('id', '!=', $admin->id)->take(4)->get());
        }

        // Note: SuperuserSeeder is intentionally not called here by default
        // Uncomment the line below to create a superuser
        // $this->call(SuperuserSeeder::class);

        // ==============================
        // Create Suppliers
        // ==============================

        // Create suppliers with realistic data
        $supplierData = [
            ['name' => 'Ford Parts Center', 'branch_name' => 'Main', 'contact_person' => 'Alice Ford', 'phone' => '011-123-4567', 'email' => 'fordcenter@example.com', 'address' => '12 Ford Ave, Johannesburg', 'website' => 'https://fordparts.example.com', 'notes' => 'Official Ford supplier'],
            ['name' => 'Toyota Parts', 'branch_name' => 'North', 'contact_person' => 'Bob Toyota', 'phone' => '012-234-5678', 'email' => 'toyotaparts@example.com', 'address' => '34 Toyota Rd, Pretoria', 'website' => 'https://toyotaparts.example.com', 'notes' => 'Genuine Toyota parts'],
            ['name' => 'VW Spares', 'branch_name' => 'East', 'contact_person' => 'Charlie VW', 'phone' => '013-345-6789', 'email' => 'vwspares@example.com', 'address' => '56 VW St, Kempton Park', 'website' => 'https://vwspares.example.com', 'notes' => 'Specializes in Volkswagen parts'],
            ['name' => 'BMW Specialists', 'branch_name' => 'West', 'contact_person' => 'David BMW', 'phone' => '014-456-7890', 'email' => 'bmwspecialists@example.com', 'address' => '78 BMW Blvd, Sandton', 'website' => 'https://bmwspecialists.example.com', 'notes' => 'Premium BMW parts'],
            ['name' => 'Premium Auto Parts', 'branch_name' => 'South', 'contact_person' => 'Eve Premium', 'phone' => '015-567-8901', 'email' => 'premiumauto@example.com', 'address' => '90 Premium Dr, Alberton', 'website' => 'https://premiumauto.example.com', 'notes' => 'All brands, premium quality'],
            ['name' => 'Budget Auto Spares', 'branch_name' => 'Central', 'contact_person' => 'Frank Budget', 'phone' => '016-678-9012', 'email' => 'budgetauto@example.com', 'address' => '123 Budget St, Roodepoort', 'website' => 'https://budgetauto.example.com', 'notes' => 'Affordable parts for all makes'],
            ['name' => 'Hyundai Parts Direct', 'branch_name' => 'Main', 'contact_person' => 'Grace Hyundai', 'phone' => '017-789-0123', 'email' => 'hyundaiparts@example.com', 'address' => '45 Hyundai Rd, Midrand', 'website' => 'https://hyundaiparts.example.com', 'notes' => 'Direct from Hyundai factory'],
        ];

        $suppliers = collect();
        foreach ($supplierData as $data) {
            $user = $users->random();
            $suppliers->push(Supplier::create(array_merge($data, [
                'created_by' => $user->id,
                'updated_by' => $user->id,
                'status' => 'active',
            ])));
        }

        // ==============================
        // Create Cars and Related Data
        // ==============================

        // Define common data pools
        $phases = ['bidding', 'fixing', 'dealership', 'sold'];
        $colors = ['Silver', 'White', 'Black', 'Red', 'Blue', 'Grey', 'Green', 'Yellow', 'Orange', 'Brown', 'Beige'];
        $bodyTypes = ['Sedan', 'Hatchback', 'SUV', 'Bakkie', 'Coupe', 'Convertible', 'Wagon', 'Van', 'MPV', 'Crossover'];
        $fuelTypes = ['Petrol', 'Diesel', 'Hybrid', 'Electric'];
        $transmissions = ['Manual', 'Automatic', 'CVT', 'Dual-Clutch'];
        $interiorTypes = ['Cloth', 'Leather', 'Synthetic', 'Alcantara'];
        $featuresPool = ['Sunroof', 'Leather seats', 'Navigation', 'Backup Camera', 'Bluetooth', 'Custom Rims', 'Custom Sound System', 'Heated Seats', 'Keyless Entry', 'Blind Spot Monitor'];

        // Car makes/models/variants
        $carData = [
            'Toyota' => ['Corolla', 'Hilux', 'Fortuner', 'RAV4', 'Yaris'],
            'Volkswagen' => ['Polo', 'Golf', 'Tiguan', 'Amarok', 'T-Cross'],
            'Ford' => ['Ranger', 'Fiesta', 'EcoSport', 'Everest', 'Mustang'],
            'Hyundai' => ['i20', 'Tucson', 'Creta', 'Santa Fe', 'Grand i10'],
            'Nissan' => ['Navara', 'X-Trail', 'Qashqai', 'Magnite', 'Almera'],
            'BMW' => ['3 Series', 'X3', 'X5', '5 Series', '1 Series'],
            'Mercedes-Benz' => ['C-Class', 'E-Class', 'GLC', 'A-Class', 'GLE'],
            'Kia' => ['Rio', 'Sportage', 'Seltos', 'Picanto', 'Sorento'],
            'Renault' => ['Kwid', 'Duster', 'Clio', 'Sandero', 'Koleos'],
            'Suzuki' => ['Swift', 'Vitara Brezza', 'Jimny', 'Baleno', 'Ignis'],
        ];

        // Car variants
        $carVariants = [
            'Toyota' => [
                'Corolla' => ['XR', 'XS', 'Quest', 'Prestige', 'Exclusive'],
                'Hilux' => ['SRX', 'Raider', 'Legend', 'GD-6', 'SR'],
                'Fortuner' => ['GD-6', 'VX', 'TX', '2.8 GD-6', '2.4 GD-6'],
            ],
            'Volkswagen' => [
                'Polo' => ['Trendline', 'Comfortline', 'Highline', 'GTI', 'R-Line'],
                'Golf' => ['TSI', 'GTI', 'R', 'Life', 'Style'],
                'Tiguan' => ['Trendline', 'Comfortline', 'Highline', 'R-Line', 'Allspace'],
            ],
            'Ford' => [
                'Ranger' => ['XL', 'XLS', 'XLT', 'Wildtrak', 'Raptor'],
                'Fiesta' => ['Ambiente', 'Trend', 'Titanium', 'ST', 'Active'],
                'EcoSport' => ['Ambiente', 'Trend', 'Titanium', 'Active', 'ST-Line'],
            ],
        ];

        // Parts data
        $partNames = [
            'Front Bumper', 'Rear Bumper', 'Hood', 'Trunk Lid', 'Front Left Door',
            'Front Right Door', 'Rear Left Door', 'Rear Right Door', 'Left Headlight',
            'Right Headlight', 'Left Taillight', 'Right Taillight', 'Front Windshield',
            'Rear Windshield', 'Front Left Fender', 'Front Right Fender', 'Radiator',
            'AC Condenser', 'Engine Control Module', 'Transmission Control Module',
            'Alternator', 'Starter Motor', 'Battery', 'Fuel Pump', 'Brake Master Cylinder',
            'ABS Module', 'Power Steering Pump', 'Steering Rack', 'Front Left Shock Absorber',
            'Front Right Shock Absorber', 'Rear Left Shock Absorber', 'Rear Right Shock Absorber',
            'Front Left Wheel', 'Front Right Wheel', 'Rear Left Wheel', 'Rear Right Wheel',
            'Catalytic Converter', 'Exhaust Manifold', 'Muffler', 'Airbag Module',
            'Dashboard', 'Center Console', 'Radio/Infotainment System', 'Instrument Cluster',
            'Driver Seat', 'Passenger Seat', 'Rear Seat', 'Seat Belt', 'Interior Trim'
        ];

        // Create 20 cars with all related data
        for ($i = 0; $i < 20; $i++) {
            // Randomly select car details
            $make = Arr::random(array_keys($carData));
            $model = Arr::random($carData[$make]);
            $variant = isset($carVariants[$make][$model]) ? Arr::random($carVariants[$make][$model]) : null;
            $phase = Arr::random($phases);
            $color = Arr::random($colors);
            $bodyType = Arr::random($bodyTypes);
            $fuelType = Arr::random($fuelTypes);
            $transmission = Arr::random($transmissions);
            $interiorType = Arr::random($interiorTypes);
            $features = Arr::random($featuresPool, rand(2, 5));
            $year = rand(2015, 2024);
            $mileage = rand(20000, 180000);

            // Generate realistic dates based on phase
            $purchaseDate = Carbon::now()->subDays(rand(30, 900));
            $repairStartDate = null;
            $repairEndDate = null;
            $dealershipDate = null;
            $soldDate = null;

            if ($phase == 'fixing' || $phase == 'dealership' || $phase == 'sold') {
                $repairStartDate = $purchaseDate->copy()->addDays(rand(5, 15));
                $repairEndDate = $repairStartDate->copy()->addDays(rand(15, 60));
            }

            if ($phase == 'dealership' || $phase == 'sold') {
                $dealershipDate = $repairEndDate->copy()->addDays(rand(3, 10));
            }

            if ($phase == 'sold') {
                $soldDate = $dealershipDate->copy()->addDays(rand(10, 90));
            }

            // Generate realistic prices
            $purchasePrice = rand(70000, 350000);
            $estimatedRepairCost = rand(5000, 60000);
            $estimatedMarketValue = $purchasePrice + $estimatedRepairCost + rand(20000, 100000);

            // Select random user
            $user = $users->random();

            // Create the car
            $car = Car::create([
                'user_id' => $user->id,
                'created_by' => $user->id,
                'updated_by' => $user->id,
                'make' => $make,
                'model' => $model,
                'variant' => $variant,
                'year' => $year,
                'vin' => strtoupper(Str::random(17)),
                'registration_number' => strtoupper(Str::random(3)) . ' ' . rand(100, 999) . ' ' . strtoupper(Str::random(2)),
                'color' => $color,
                'interior_type' => $interiorType,
                'body_type' => $bodyType,
                'engine_size' => rand(1, 4) . '.' . rand(0, 9) . 'L',
                'fuel_type' => $fuelType,
                'transmission' => $transmission,
                'mileage' => $mileage,
                'features' => $features,
                'purchase_date' => $purchaseDate,
                'purchase_price' => $purchasePrice,
                'auction_house' => 'Auction House ' . rand(1, 5),
                'auction_branch' => 'Branch ' . rand(1, 3),
                'auction_lot_number' => 'LOT' . rand(100, 999),
                'damage_description' => 'Vehicle has ' . Arr::random(['front', 'rear', 'side', 'multiple']) . ' damage with ' .
                                       Arr::random(['minor', 'moderate', 'significant']) . ' structural issues.',
                'damage_severity' => Arr::random(['light', 'moderate', 'severe']),
                'operational_status' => Arr::random(['running', 'non-running']),
                'vehicle_code' => Arr::random(['code_2', 'code_3', 'code_4']),
                'current_phase' => $phase,
                'repair_start_date' => $repairStartDate,
                'repair_end_date' => $repairEndDate,
                'dealership_date' => $dealershipDate,
                'sold_date' => $soldDate,
                'transportation_cost' => rand(1000, 5000),
                'registration_papers_cost' => rand(500, 2000),
                'number_plates_cost' => rand(200, 800),
                'dealership_discount' => rand(0, 5000),
                'other_costs' => rand(0, 3000),
                'other_costs_description' => Arr::random(['Towing fees', 'Storage fees', 'Cleaning', 'Inspection fees', 'None']),
                'estimated_repair_cost' => $estimatedRepairCost,
                'estimated_market_value' => $estimatedMarketValue,
                'notes' => 'This ' . $year . ' ' . $make . ' ' . $model . ' was purchased from ' .
                          'Auction House ' . rand(1, 5) . ' with ' . Arr::random(['minor', 'moderate', 'severe']) . ' damage.',
                'form_completed' => true,
                'form_step' => 4,
                'status' => 'active',
            ]);

            // Create Car Images
            $imageTypes = ['before_repair', 'during_repair', 'after_repair', 'damage', 'other'];
            foreach ($imageTypes as $type) {
                if ($type == 'during_repair' && $phase == 'bidding') continue;
                if ($type == 'after_repair' && ($phase == 'bidding' || $phase == 'fixing')) continue;

                CarImage::create([
                    'car_id' => $car->id,
                    'image_path' => 'cars/' . strtolower($make . '-' . $model) . '-' . $type . '.jpg',
                    'image_type' => $type,
                    'description' => ucfirst($type) . ' view of ' . $make . ' ' . $model,
                ]);
            }

            // Create Damaged Parts (3-8 per car)
            $partLocations = ['front', 'rear', 'driver side', 'passenger side', 'engine bay', 'interior', 'undercarriage'];
            $damagedPartsCount = rand(3, 8);
            $usedParts = [];

            for ($j = 0; $j < $damagedPartsCount; $j++) {
                $partName = Arr::random($partNames);
                if (in_array($partName, $usedParts)) continue;
                $usedParts[] = $partName;

                $isRepaired = $phase == 'bidding' ? false : ($phase == 'fixing' ? (rand(0, 1) == 1) : true);

                DamagedPart::create([
                    'car_id' => $car->id,
                    'created_by' => $user->id,
                    'updated_by' => $user->id,
                    'part_name' => $partName,
                    'part_location' => Arr::random($partLocations),
                    'damage_description' => Arr::random(['Dented', 'Scratched', 'Cracked', 'Broken', 'Bent', 'Torn', 'Malfunctioning']) . ' ' . $partName,
                    'estimated_repair_cost' => rand(500, 10000),
                    'needs_replacement' => rand(0, 1) == 1,
                    'image_path' => 'damaged_parts/' . strtolower(str_replace(' ', '_', $partName)) . '.jpg',
                    'is_repaired' => $isRepaired,
                    'status' => 'active',
                ]);
            }

            // Create Parts (4-15 per car)
            $partsCount = rand(4, 15);
            $usedParts = [];

            for ($j = 0; $j < $partsCount; $j++) {
                $partName = Arr::random($partNames);
                if (in_array($partName, $usedParts)) continue;
                $usedParts[] = $partName;

                $supplier = $suppliers->random();
                $quantity = rand(1, 3);
                $unitPrice = rand(500, 15000);
                $totalPrice = $quantity * $unitPrice;

                // For bidding phase, use purchase date instead of null
                $purchasePartDate = $phase == 'bidding' ? $purchaseDate->copy() : $repairStartDate->copy()->addDays(rand(1, 10));
                $installationDate = $phase == 'bidding' ? null : ($phase == 'fixing' ? ($purchasePartDate->copy()->addDays(rand(1, 15))) : $purchasePartDate->copy()->addDays(rand(1, 15)));

                Part::create([
                    'car_id' => $car->id,
                    'name' => $partName,
                    'description' => Arr::random(['OEM', 'Aftermarket', 'Refurbished', 'Used']) . ' ' . $partName,
                    'condition' => Arr::random(['new', 'used', 'refurbished']),
                    'quantity' => $quantity,
                    'unit_price' => $unitPrice,
                    'total_price' => $totalPrice,
                    'purchase_date' => $purchasePartDate,
                    'installation_date' => $installationDate,
                    'supplier_id' => $supplier->id,
                ]);
            }

            // Create Labor entries (2-5 per car)
            if ($phase != 'bidding') {
                $laborTypes = ['Body Work', 'Mechanical Repair', 'Electrical Repair', 'Painting Prep', 'Interior Work', 'Diagnostics'];
                $laborCount = rand(2, 5);

                for ($j = 0; $j < $laborCount; $j++) {
                    $laborType = $laborTypes[$j % count($laborTypes)];
                    $hours = rand(2, 20);
                    $hourlyRate = rand(200, 600);
                    $totalCost = $hours * $hourlyRate;

                    $startDate = $repairStartDate->copy()->addDays(rand(0, 10));
                    $completionDate = $phase == 'fixing' ? ($startDate->copy()->addDays(rand(1, 10))) : $startDate->copy()->addDays(rand(1, 10));

                    Labor::create([
                        'car_id' => $car->id,
                        'service_type' => $laborType,
                        'description' => $laborType . ' for ' . $make . ' ' . $model,
                        'provider_name' => 'Technician ' . rand(1, 10),
                        'provider_contact' => '0' . rand(10, 99) . '-' . rand(100, 999) . '-' . rand(1000, 9999),
                        'hours' => $hours,
                        'hourly_rate' => $hourlyRate,
                        'total_cost' => $totalCost,
                        'service_date' => $startDate,
                        'completion_date' => $completionDate,
                    ]);
                }
            }

            // Create Painting entry
            if ($phase != 'bidding') {
                $paintingType = Arr::random(['full', 'partial']);
                $areasCovered = $paintingType == 'full' ? 'entire car' : Arr::random(['front', 'rear', 'left side', 'right side', 'hood and fenders']);
                $materialCost = rand(1000, 5000);
                $laborCost = rand(2000, 8000);
                $totalCost = $materialCost + $laborCost;

                $startDate = $repairStartDate->copy()->addDays(rand(5, 15));
                $completionDate = $phase == 'fixing' ? ($startDate->copy()->addDays(rand(3, 10))) : $startDate->copy()->addDays(rand(3, 10));

                Painting::create([
                    'car_id' => $car->id,
                    'painting_type' => $paintingType,
                    'areas_covered' => $areasCovered,
                    'provider_name' => Arr::random(['ColorMaster', 'PaintPro', 'AutoFinish', 'PremiumPaint', 'SprayKing']),
                    'provider_contact' => '0' . rand(10, 99) . '-' . rand(100, 999) . '-' . rand(1000, 9999),
                    'material_cost' => $materialCost,
                    'labor_cost' => $laborCost,
                    'total_cost' => $totalCost,
                    'start_date' => $startDate,
                    'completion_date' => $completionDate,
                ]);
            }

            // Create Documents
            $documentTypes = ['registration', 'insurance', 'service_history', 'inspection_report', 'auction_invoice'];
            foreach ($documentTypes as $docType) {
                Document::create([
                    'car_id' => $car->id,
                    'document_type' => $docType,
                    'file_path' => 'docs/' . strtolower($make . '-' . $model) . '-' . $docType . '.pdf',
                    'description' => ucwords(str_replace('_', ' ', $docType)) . ' for ' . $make . ' ' . $model,
                    'upload_date' => $purchaseDate->copy()->addDays(rand(1, 30)),
                ]);
            }

            // Create Images (polymorphic)
            Image::create([
                'imageable_id' => $car->id,
                'imageable_type' => Car::class,
                'image_path' => 'cars/' . strtolower($make . '-' . $model) . '-gallery.jpg',
                'image_type' => 'gallery',
                'description' => 'Gallery image of ' . $make . ' ' . $model,
            ]);

            // Create Sale information for dealership or sold phases
            if ($phase == 'dealership' || $phase == 'sold') {
                $askingPrice = $estimatedMarketValue + rand(10000, 50000);
                $sellingPrice = $phase == 'sold' ? ($askingPrice - rand(0, 30000)) : null;

                Sale::create([
                    'car_id' => $car->id,
                    'listing_date' => $dealershipDate,
                    'asking_price' => $askingPrice,
                    'platform' => Arr::random(['Dealership', 'Auction', 'Private', 'Online']),
                    'selling_price' => $sellingPrice,
                    'sale_date' => $soldDate,
                    'buyer_name' => $phase == 'sold' ? 'Buyer ' . rand(1, 20) : null,
                    'buyer_contact' => $phase == 'sold' ? '0' . rand(60, 85) . '-' . rand(100, 999) . '-' . rand(1000, 9999) : null,
                    'commission' => $phase == 'sold' ? rand(0, 10000) : null,
                    'fees' => $phase == 'sold' ? rand(0, 5000) : null,
                    'notes' => $phase == 'sold' ? 'Sold successfully to ' . 'Buyer ' . rand(1, 20) : 'Currently listed for sale',
                ]);
            }
        }

        // ==============================
        // Seed Report Types
        // ==============================

        $this->call(ReportTypeSeeder::class);
    }
}
