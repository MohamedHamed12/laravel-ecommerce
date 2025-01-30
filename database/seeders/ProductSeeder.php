<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    public function run()
    {
        // Insert product data
        Product::factory()->create([
            'title' => 'Melange Casual Black',
            'slug' => 'melange-casual-black',
            'summary' => 'A stylish and comfortable black casual wear.',
            'description' => 'Made with soft, breathable fabric, perfect for casual outings.',
            'photo' => '/storage/photos/products/melange-casual-black.jpg',
            'stock' => 50,
            'size' => 'M',
            'condition' => 'new',
            'status' => 'active',
            'price' => 999,
            'discount' => 20,
            'is_featured' => true,
            'cat_id' => 1, // Assuming category with ID 1
            'child_cat_id' => 4, // Assuming child category with ID 4
            'brand_id' => 1, // Assuming brand with ID 1
        ]);
    }
}
