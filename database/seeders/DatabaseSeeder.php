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
        // Admin User. Must be a Super Admin: the role column defaults to "writer",
        // which only sees Artikel in the admin panel.
        // Note: updateOrCreate resets this account's password every time the seeder runs.
        $admin = User::updateOrCreate(
            ['email' => 'admin@erlass.co.id'],
            [
                'name' => 'Admin Erlass',
                'password' => Hash::make('Erlass101'),
                'email_verified_at' => now(),
            ]
        );
        $admin->forceFill(['role' => User::ROLE_SUPER_ADMIN, 'is_active' => true])->save();

        // Seed Categories, Products, and Partner Schools synced from CRM
        $this->call([
            CrmDataSeeder::class,
            LmsCatalogSeeder::class,
            ArticleSeeder::class,
            GallerySeeder::class,
            FaqSeeder::class,
        ]);
    }
}
