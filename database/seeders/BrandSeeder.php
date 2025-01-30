<?php

namespace Database\Seeders;

use App\Models\Brand;
use Illuminate\Database\Seeder;

class BrandSeeder extends Seeder
{
    public function run()
    {
        // Insert brands into the database
        Brand::factory()->create([
            'title' => 'Adidas',
            'slug' => 'adidas',
            'status' => 'active',
        ]);

        Brand::factory()->create([
            'title' => 'Nike',
            'slug' => 'nike',
            'status' => 'active',
        ]);

        Brand::factory()->create([
            'title' => 'Kappa',
            'slug' => 'kappa',
            'status' => 'active',
        ]);

        Brand::factory()->create([
            'title' => 'Prada',
            'slug' => 'prada',
            'status' => 'active',
        ]);

        Brand::factory()->create([
            'title' => 'Brand',
            'slug' => 'brand',
            'status' => 'active',
        ]);
    }
}
