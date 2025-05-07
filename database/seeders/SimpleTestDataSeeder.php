<?php

namespace Database\Seeders;

use App\Models\Car;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class SimpleTestDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create admin user
        $admin = User::create([
            'id' => Str::uuid(),
            'first_name' => 'Admin',
            'last_name' => 'User',
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'phone' => '123-456-7890',
            'gender' => 'male',
            'role' => 'admin',
            'status' => 'active',
            'password' => Hash::make('password'),
        ]);

        // Create regular user
        $user = User::create([
            'id' => Str::uuid(),
            'first_name' => 'Test',
            'last_name' => 'User',
            'name' => 'Test User',
            'email' => 'user@example.com',
            'phone' => '987-654-3210',
            'gender' => 'female',
            'role' => 'user',
            'status' => 'active',
            'password' => Hash::make('password'),
        ]);

        // Create a few cars
        $car1 = Car::create([
            'user_id' => $user->id,
            'created_by' => $admin->id,
            'updated_by' => $admin->id,
            'make' => 'Toyota',
            'model' => 'Corolla',
            'variant' => 'XLE',
            'year' => 2020,
            'vin' => strtoupper(Str::random(17)),
            'registration_number' => 'ABC123GP',
            'color' => 'Silver',
            'interior_type' => 'Leather',
            'body_type' => 'Sedan',
            'engine_size' => '1.8L',
            'fuel_type' => 'Petrol',
            'transmission' => 'Automatic',
            'mileage' => 45000,
            'features' => json_encode(['Sunroof', 'Navigation', 'Bluetooth']),
            'purchase_date' => now()->subMonths(3),
            'purchase_price' => 150000,
            'auction_house' => 'ABC Auctions',
            'auction_branch' => 'Johannesburg',
            'auction_lot_number' => 'LOT123',
            'damage_description' => 'Front bumper damage, minor scratches',
            'damage_severity' => 'moderate',
            'operational_status' => 'running',
            'vehicle_code' => 'code_3',
            'current_phase' => 'fixing',
            'repair_start_date' => now()->subMonths(2),
            'estimated_repair_cost' => 25000,
            'estimated_market_value' => 180000,
            'notes' => 'Good condition overall',
            'form_completed' => true,
            'form_step' => 4,
            'status' => 'active',
        ]);

        $car2 = Car::create([
            'user_id' => $admin->id,
            'created_by' => $admin->id,
            'updated_by' => $admin->id,
            'make' => 'Ford',
            'model' => 'Ranger',
            'variant' => 'Wildtrak',
            'year' => 2021,
            'vin' => strtoupper(Str::random(17)),
            'registration_number' => 'XYZ789GP',
            'color' => 'Blue',
            'interior_type' => 'Leather',
            'body_type' => 'Bakkie',
            'engine_size' => '2.0L',
            'fuel_type' => 'Diesel',
            'transmission' => 'Automatic',
            'mileage' => 35000,
            'features' => json_encode(['Navigation', 'Bluetooth', 'Backup Camera']),
            'purchase_date' => now()->subMonths(2),
            'purchase_price' => 250000,
            'auction_house' => 'XYZ Auctions',
            'auction_branch' => 'Cape Town',
            'auction_lot_number' => 'LOT456',
            'damage_description' => 'Rear bumper damage, side panel dents',
            'damage_severity' => 'severe',
            'operational_status' => 'running',
            'vehicle_code' => 'code_3',
            'current_phase' => 'dealership',
            'repair_start_date' => now()->subMonths(1),
            'repair_end_date' => now()->subWeeks(2),
            'dealership_date' => now()->subWeeks(1),
            'estimated_repair_cost' => 45000,
            'estimated_market_value' => 280000,
            'notes' => 'Fully repaired and ready for sale',
            'form_completed' => true,
            'form_step' => 4,
            'status' => 'active',
        ]);

        $this->command->info('Simple test data created successfully!');
        $this->command->info('Admin user: admin@example.com / password');
        $this->command->info('Regular user: user@example.com / password');
        $this->command->info('Created 2 users and 2 cars');
    }
}
