<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Car;
use App\Models\CarImage;
use App\Models\DamagedPart;
use App\Models\Document;
use App\Models\FailedJob;
use App\Models\Image;
use App\Models\Labor;
use App\Models\Painting;
use App\Models\Part;
use App\Models\Sale;
use App\Models\Supplier;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Arr;
use Carbon\Carbon;

class TestDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $phases = ['bidding', 'fixing', 'dealership', 'sold'];
        $colors = ['Silver', 'White', 'Black', 'Red', 'Blue', 'Grey', 'Green', 'Yellow', 'Orange', 'Brown', 'Beige'];
        $bodyTypes = ['Sedan', 'Hatchback', 'SUV', 'Bakkie', 'Coupe', 'Convertible', 'Wagon', 'Van', 'MPV', 'Crossover'];
        $fuelTypes = ['Petrol', 'Diesel', 'Hybrid', 'Electric'];
        $transmissions = ['Manual', 'Automatic', 'CVT', 'Dual-Clutch'];
        $interiorTypes = ['Cloth', 'Leather', 'Synthetic', 'Alcantara'];
        $featuresPool = ['Sunroof', 'Leather seats', 'Navigation', 'Backup Camera', 'Bluetooth', 'Custom Rims', 'Custom Sound System', 'Heated Seats', 'Keyless Entry', 'Blind Spot Monitor'];
        $partNames = [
            'Front Bumper', 'Rear Bumper', 'Radiator', 'Alternator', 'Starter Motor', 'Battery', 'Headlight (L)', 'Headlight (R)', 'Taillight (L)', 'Taillight (R)',
            'Bonnet', 'Boot Lid', 'Left Door', 'Right Door', 'Windscreen', 'Side Mirror (L)', 'Side Mirror (R)', 'Grille', 'Fender (L)', 'Fender (R)',
            'Shock Absorber', 'Control Arm', 'Brake Disc', 'Brake Pad', 'Fuel Pump', 'Water Pump', 'Timing Belt', 'Drive Shaft', 'Catalytic Converter', 'Exhaust',
            'Oil Filter', 'Air Filter', 'Cabin Filter', 'Spark Plug', 'Ignition Coil', 'AC Compressor', 'Power Steering Pump', 'Clutch', 'Gearbox', 'Transmission Mount',
            'Wheel (L)', 'Wheel (R)', 'Tyre (L)', 'Tyre (R)', 'Seatbelt', 'Dashboard', 'Steering Wheel', 'Instrument Cluster', 'Radiator Fan', 'Door Handle'
        ];

        // Car makes/models/variants from car-data.js and car-variants-data.js (sampled for PHP)
        $carData = [
            'Toyota' => ['Corolla', 'Hilux', 'Fortuner', 'RAV4', 'Yaris'],
            'Volkswagen' => ['Polo', 'Golf', 'Tiguan'],
            'Ford' => ['Ranger', 'Fiesta', 'EcoSport'],
            'Hyundai' => ['i20', 'Tucson', 'Creta'],
            'Nissan' => ['Navara', 'X-Trail', 'Qashqai'],
            'BMW' => ['3 Series', 'X3', 'X5'],
            'Kia' => ['Rio', 'Sportage', 'Seltos'],
            'Renault' => ['Kwid', 'Duster', 'Clio'],
            'Suzuki' => ['Swift', 'Vitara Brezza', 'Jimny'],
            'Honda' => ['Civic', 'Jazz', 'CR-V'],
        ];
        $carVariants = [
            'Toyota' => [
                'Corolla' => ['1.6', '1.8', 'Prestige', 'Quest', 'GR Sport'],
                'Hilux' => ['2.4 GD-6', '2.8 GD-6', 'Legend 50', 'Raider'],
            ],
            'Volkswagen' => [
                'Golf' => ['GTI', 'R', 'Trendline'],
                'Polo' => ['Vivo', 'GTI', 'Comfortline'],
            ],
            'Ford' => [
                'Ranger' => ['Wildtrak', 'Raptor', 'XLT'],
                'Fiesta' => ['ST', 'Titanium', 'Trend'],
            ],
            'Hyundai' => [
                'i20' => ['Fluid', 'Motion', 'N'],
                'Tucson' => ['Elite', 'N Line', 'Premium'],
            ],
            'Nissan' => [
                'Navara' => ['Pro-4X', 'LE', 'XE'],
                'X-Trail' => ['Acenta', 'Tekna', 'Visia'],
            ],
        ];

        // Create a pool of unique suppliers with real names
        $supplierData = [
            ['name' => 'Ford Parts Center', 'branch_name' => 'Main', 'contact_person' => 'Alice Ford', 'phone' => '011-123-4567', 'email' => 'fordcenter@example.com', 'address' => '12 Ford Ave, City', 'website' => 'https://fordparts.example.com', 'notes' => 'Official Ford supplier'],
            ['name' => 'Toyota Parts', 'branch_name' => 'North', 'contact_person' => 'Bob Toyota', 'phone' => '012-234-5678', 'email' => 'toyotaparts@example.com', 'address' => '34 Toyota Rd, City', 'website' => 'https://toyotaparts.example.com', 'notes' => 'Genuine Toyota parts'],
            ['name' => 'Scrap Yard', 'branch_name' => 'East', 'contact_person' => 'Charlie Scrap', 'phone' => '013-345-6789', 'email' => 'scrapyard@example.com', 'address' => '56 Scrap St, City', 'website' => 'https://scrapyard.example.com', 'notes' => 'Used and rare parts'],
            ['name' => 'VW Spares', 'branch_name' => 'West', 'contact_person' => 'Diana VW', 'phone' => '014-456-7890', 'email' => 'vwspares@example.com', 'address' => '78 VW Blvd, City', 'website' => 'https://vwspares.example.com', 'notes' => 'Volkswagen specialist'],
            ['name' => 'Premium Auto Parts', 'branch_name' => 'South', 'contact_person' => 'Eve Premium', 'phone' => '015-567-8901', 'email' => 'premiumauto@example.com', 'address' => '90 Premium Dr, City', 'website' => 'https://premiumauto.example.com', 'notes' => 'All brands, premium quality'],
        ];
        $users = User::all();
        $suppliers = collect();
        foreach ($supplierData as $i => $data) {
            $user = $users[$i % $users->count()];
            $suppliers->push(Supplier::create(array_merge($data, [
                'created_by' => $user->id,
                'updated_by' => $user->id,
                'status' => 'active',
            ])));
        }

        for ($i = 0; $i < 10; $i++) {
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
            $purchaseDate = Carbon::now()->subDays(rand(30, 900));
            $purchasePrice = rand(70000, 350000);
            $damageSeverity = Arr::random(['light', 'moderate', 'severe']);
            $operationalStatus = Arr::random(['running', 'non-running']);
            $vehicleCode = Arr::random(['Code 2', 'Code 3', 'Code 4']);
            $user = $users[$i % $users->count()];
            $supplier = $suppliers[$i % $suppliers->count()];

            $car = Car::create([
                'user_id' => $user->id,
                'created_by' => $user->id,
                'updated_by' => $user->id,
                'make' => $make,
                'model' => $model,
                'variant' => $variant,
                'year' => $year,
                'vin' => strtoupper(Str::random(17)),
                'registration_number' => strtoupper(Str::random(8)),
                'color' => $color,
                'interior_type' => $interiorType,
                'body_type' => $bodyType,
                'engine_size' => rand(1, 4) . '.' . rand(0, 9) . 'L',
                'fuel_type' => $fuelType,
                'transmission' => $transmission,
                'mileage' => $mileage,
                'features' => json_encode($features),
                'purchase_date' => $purchaseDate,
                'purchase_price' => $purchasePrice,
                'auction_house' => 'Auction House ' . rand(1, 5),
                'auction_branch' => 'Branch ' . rand(1, 3),
                'auction_lot_number' => 'LOT' . rand(100, 999),
                'damage_description' => 'Random damage description',
                'damage_severity' => $damageSeverity,
                'operational_status' => $operationalStatus,
                'vehicle_code' => $vehicleCode,
                'current_phase' => $phase,
                'repair_start_date' => $purchaseDate->copy()->addDays(rand(1, 10)),
                'repair_end_date' => $purchaseDate->copy()->addDays(rand(11, 30)),
                'dealership_date' => $purchaseDate->copy()->addDays(rand(31, 60)),
                'sold_date' => $phase === 'sold' ? $purchaseDate->copy()->addDays(rand(61, 120)) : null,
                'transportation_cost' => rand(1000, 5000),
                'registration_papers_cost' => rand(500, 2000),
                'number_plates_cost' => rand(300, 800),
                'dealership_discount' => rand(0, 5000),
                'other_costs' => rand(0, 2000),
                'other_costs_description' => 'Other costs',
                'estimated_repair_cost' => rand(5000, 60000),
                'estimated_market_value' => rand(100000, 400000),
                'notes' => 'Auto-generated car',
                'form_completed' => true,
                'form_step' => 4,
                'status' => 'active',
            ]);

            // Car Images
            CarImage::create([
                'car_id' => $car->id,
                'image_path' => 'cars/' . strtolower($make . '-' . $model) . '-front.jpg',
                'image_type' => 'before_repair',
                'description' => 'Front view before repair',
            ]);
            CarImage::create([
                'car_id' => $car->id,
                'image_path' => 'cars/' . strtolower($make . '-' . $model) . '-after.jpg',
                'image_type' => 'after_repair',
                'description' => 'Front view after repair',
            ]);

            // Damaged Parts (2-5 per car)
            foreach (Arr::random($partNames, rand(2, 5)) as $partName) {
                DamagedPart::create([
                    'car_id' => $car->id,
                    'part_name' => $partName,
                    'part_location' => Arr::random(['front', 'rear', 'left', 'right']),
                    'damage_description' => 'Random damage to ' . $partName,
                    'estimated_repair_cost' => rand(500, 12000),
                    'needs_replacement' => (bool)rand(0, 1),
                    'image_path' => 'cars/' . strtolower($make . '-' . $model) . '-' . strtolower(str_replace(' ', '-', $partName)) . '-damage.jpg',
                    'is_repaired' => (bool)rand(0, 1),
                ]);
            }

            // Documents
            Document::create([
                'car_id' => $car->id,
                'document_type' => 'registration',
                'file_path' => 'docs/' . strtolower($make . '-' . $model) . '-registration.pdf',
                'description' => 'Registration document',
                'upload_date' => $purchaseDate->copy()->addDays(1),
            ]);

            // Images (polymorphic, e.g. for car)
            Image::create([
                'imageable_id' => $car->id,
                'imageable_type' => Car::class,
                'image_path' => 'cars/' . strtolower($make . '-' . $model) . '-gallery.jpg',
                'image_type' => 'gallery',
                'description' => 'Gallery image',
            ]);

            // Labor
            Labor::create([
                'car_id' => $car->id,
                'service_type' => Arr::random(['Panel Beating', 'Mechanical', 'Electrical', 'Detailing']),
                'description' => 'Labor for ' . $model,
                'provider_name' => 'Provider ' . rand(1, 10),
                'provider_contact' => '021-555-' . rand(1000, 9999),
                'hours' => rand(5, 40),
                'hourly_rate' => rand(200, 800),
                'total_cost' => rand(2000, 20000),
                'service_date' => $purchaseDate->copy()->addDays(rand(2, 20)),
                'completion_date' => $purchaseDate->copy()->addDays(rand(21, 40)),
            ]);

            // Painting
            Painting::create([
                'car_id' => $car->id,
                'painting_type' => Arr::random(['full', 'partial']),
                'areas_covered' => Arr::random(['entire car', 'front', 'rear', 'left side', 'right side']),
                'provider_name' => 'ColorMaster',
                'provider_contact' => '021-555-' . rand(1000, 9999),
                'material_cost' => rand(1000, 4000),
                'labor_cost' => rand(1000, 4000),
                'total_cost' => rand(2000, 8000),
                'start_date' => $purchaseDate->copy()->addDays(rand(5, 25)),
                'completion_date' => $purchaseDate->copy()->addDays(rand(26, 45)),
            ]);

            // Parts (4-22 unique per car)
            $usedParts = [];
            foreach (Arr::random($partNames, rand(4, 22)) as $partName) {
                if (in_array($partName, $usedParts)) continue;
                $usedParts[] = $partName;
                Part::create([
                    'car_id' => $car->id,
                    'name' => $partName,
                    'description' => 'OEM or quality replacement',
                    'condition' => Arr::random(['new', 'used', 'refurbished']),
                    'quantity' => rand(1, 2),
                    'unit_price' => rand(500, 15000),
                    'total_price' => rand(500, 15000) * rand(1, 2),
                    'purchase_date' => $purchaseDate->copy()->addDays(rand(10, 60)),
                    'installation_date' => $purchaseDate->copy()->addDays(rand(20, 80)),
                    'supplier_id' => $supplier->id,
                ]);
            }

            // Sale
            Sale::create([
                'car_id' => $car->id,
                'listing_date' => $purchaseDate->copy()->addDays(rand(40, 90)),
                'asking_price' => rand(120000, 450000),
                'platform' => Arr::random(['Dealership', 'Auction', 'Private']),
                'selling_price' => $phase === 'sold' ? rand(120000, 450000) : null,
                'sale_date' => $phase === 'sold' ? $purchaseDate->copy()->addDays(rand(91, 180)) : null,
                'buyer_name' => $phase === 'sold' ? 'Buyer ' . rand(1, 20) : null,
                'buyer_contact' => $phase === 'sold' ? '082-' . rand(1000000, 9999999) : null,
                'commission' => rand(0, 10000),
                'fees' => rand(0, 5000),
                'notes' => $phase === 'sold' ? 'Sold successfully' : 'Not yet sold',
            ]);
        }
    }
}
