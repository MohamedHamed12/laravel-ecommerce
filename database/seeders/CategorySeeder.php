<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run()
    {
        // Insert parent categories (those with `is_parent = 1` and `parent_id = null`)
        Category::factory()->create([
            'title' => 'Men\'s Fashion',
            'slug' => 'mens-fashion',
            'summary' => null,
            'photo' => '/storage/photos/1/Category/mini-banner1.jpg',
            'is_parent' => 1,
            'parent_id' => null,
            'added_by' => null,
            'status' => 'active',
        ]);

        Category::factory()->create([
            'title' => 'Women\'s Fashion',
            'slug' => 'womens-fashion',
            'summary' => null,
            'photo' => '/storage/photos/1/Category/mini-banner2.jpg',
            'is_parent' => 1,
            'parent_id' => null,
            'added_by' => null,
            'status' => 'active',
        ]);

        Category::factory()->create([
            'title' => 'Kid\'s',
            'slug' => 'kids',
            'summary' => null,
            'photo' => '/storage/photos/1/Category/mini-banner3.jpg',
            'is_parent' => 1,
            'parent_id' => null,
            'added_by' => null,
            'status' => 'active',
        ]);

        // Insert child categories (those with `is_parent = 0` and a valid `parent_id`)
        Category::factory()->create([
            'title' => 'T-shirt\'s',
            'slug' => 't-shirts',
            'summary' => null,
            'photo' => null,
            'is_parent' => 0,
            'parent_id' => 1, // Assuming parent category with ID 1 exists
            'added_by' => null,
            'status' => 'active',
        ]);

        Category::factory()->create([
            'title' => 'Jeans pants',
            'slug' => 'jeans-pants',
            'summary' => null,
            'photo' => null,
            'is_parent' => 0,
            'parent_id' => 1,
            'added_by' => null,
            'status' => 'active',
        ]);

        Category::factory()->create([
            'title' => 'Sweater & Jackets',
            'slug' => 'sweater-jackets',
            'summary' => null,
            'photo' => null,
            'is_parent' => 0,
            'parent_id' => 1,
            'added_by' => null,
            'status' => 'active',
        ]);

        Category::factory()->create([
            'title' => 'Rain Coats & Trenches',
            'slug' => 'rain-coats-trenches',
            'summary' => null,
            'photo' => null,
            'is_parent' => 0,
            'parent_id' => 1,
            'added_by' => null,
            'status' => 'active',
        ]);
    }
}
