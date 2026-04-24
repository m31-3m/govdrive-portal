<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. Create the official Administrative Account
        User::create([
            'name' => 'GovDrive Admin',
            'email' => 'admin@gov.ph',
            'password' => Hash::make('password123'),
            'role' => 1, // 1 = Admin
        ]);

        // 2. Create a standard Citizen Account
        User::create([
            'name' => 'Juan Dela Cruz',
            'email' => 'juan@citizen.com',
            'password' => Hash::make('password123'),
            'role' => 0, // 0 = Citizen
        ]);

        echo "\n Seeders successful! \n Admin: admin@gov.ph \n Citizen: juan@citizen.com \n Password: password123 \n\n";
    }
}