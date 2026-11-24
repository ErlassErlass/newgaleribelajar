<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Admin User for local development / testing
        User::firstOrCreate(
            ['email' => 'admin@erlass.co.id'],
            [
                'name' => 'Admin Erlass',
                'password' => Hash::make('password'),
                'email_verified_at' => now(),
            ]
        );

        // Seed Categories, Products, and Partner Schools synced from CRM
        $this->call([
            CrmDataSeeder::class,
        ]);
    }
}
