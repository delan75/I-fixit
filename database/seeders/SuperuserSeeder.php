<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class SuperuserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create a superuser
        User::create([
            'id' => Str::uuid(),
            'first_name' => 'Super',
            'last_name' => 'Admin',
            'name' => 'Super Admin',
            'email' => 'superadmin@example.com',
            'phone' => '1234567890',
            'password' => Hash::make('password'),
            'role' => 'admin',
            'is_superuser' => true,
            'status' => 'active',
        ]);

        $this->command->info('Superuser created successfully!');
        $this->command->info('Email: superadmin@example.com');
        $this->command->info('Password: password');
        $this->command->info('Please change the password after first login.');
    }
}
