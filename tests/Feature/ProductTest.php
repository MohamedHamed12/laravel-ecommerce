<?php

namespace Tests\Feature;

use App\Models\Product;
use App\Models\Category;
use App\Models\Brand;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Database\Seeders\ProductSeeder;

// class ProductTest extends TestCase
// {
//     use RefreshDatabase;


    // public function  test_it_can_create_a_products()
    // {
    //     // Seed categories and brands first
    //     Category::factory()->create([
    //         'id' => 1,
    //         'title' => 'Men\'s Fashion',
    //         'slug' => 'mens-fashion',
    //         'status' => 'active',
    //     ]);

    //     Brand::factory()->create([
    //         'id' => 1,
    //         'title' => 'Adidas',
    //         'slug' => 'adidas',
    //         'status' => 'active',
    //     ]);

    //     // Seed the products
    //     $this->seed(ProductSeeder::class);

    //     // Check if the product exists in the database
    //     $this->assertDatabaseHas('products', [
    //         'title' => 'Melange Casual Black',
    //         'slug' => 'melange-casual-black',
    //         'summary' => 'A stylish and comfortable black casual wear.',
    //         'status' => 'active',
    //         'price' => 999,
    //     ]);
    // }

    // public function test_it_can_create_a_product()
    // {
    //     $brand =    Brand::factory()->create([
    //         'title' => 'Adidas',
    //         'slug' => 'adidas',
    //         'status' => 'active',
    //     ]);
    //     $category =  Category::factory()->create([
    //         'title' => 'Women\'s Fashion',
    //         'slug' => 'womens-fashion',
    //         'summary' => null,
    //         'photo' => '/storage/photos/1/Category/mini-banner2.jpg',
    //         'is_parent' => 1,
    //         'parent_id' => null,
    //         'added_by' => null,
    //         'status' => 'active',
    //     ]);

    //     $response = $this->postJson('/api/products', [
    //         'title' => 'Melange Casual Black',
    //         'slug' => 'melange-casual-black',
    //         'summary' => 'A stylish and comfortable black casual wear.',
    //         'photo' => '/storage/photos/products/melange-casual-black.jpg',
    //         'stock' => 50,
    //         'size' => 'M',
    //         'status' => 'active',
    //         'price' => 999,
    //         'discount' => 20,
    //         'is_featured' => true,
    //         'cat_id' => $category->id, // Assuming category with ID 1

    //     ]);

    //     $response->assertStatus(201);
    // }
// }
