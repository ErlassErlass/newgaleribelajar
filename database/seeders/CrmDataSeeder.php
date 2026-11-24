<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;
use App\Models\Product;
use App\Models\Partner;
use Illuminate\Support\Facades\DB;

class CrmDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categoriesFile = __DIR__ . '/data/categories.json';
        $productsFile = __DIR__ . '/data/products.json';
        $partnersFile = __DIR__ . '/data/partners.json';

        if (file_exists($categoriesFile)) {
            $categories = json_decode(file_get_contents($categoriesFile), true);
            foreach ($categories as $cat) {
                Category::updateOrCreate(['slug' => $cat['slug']], $cat);
            }
        }

        if (file_exists($productsFile)) {
            $products = json_decode(file_get_contents($productsFile), true);
            foreach ($products as $prod) {
                // Ensure json fields are handled properly
                if (isset($prod['features']) && is_string($prod['features'])) {
                    $prod['features'] = json_decode($prod['features'], true);
                }
                if (isset($prod['education_levels']) && is_string($prod['education_levels'])) {
                    $prod['education_levels'] = json_decode($prod['education_levels'], true);
                }
                Product::updateOrCreate(['sku' => $prod['sku']], $prod);
            }
        }

        if (file_exists($partnersFile)) {
            $partners = json_decode(file_get_contents($partnersFile), true);
            foreach ($partners as $partner) {
                Partner::updateOrCreate(['slug' => $partner['slug']], $partner);
            }
        }
    }
}
