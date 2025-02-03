<?php

namespace Tests\Feature;

use App\Models\Product;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\Brand;
use App\Models\Review;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProductControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test fetching a paginated list of products.
     */
    public function test_index(): void
    {
        // Create 15 products with related models
        Product::factory()
            ->count(1)
            // ->for(Category::factory(), 'cat_info')
            // ->for(Category::factory(), 'sub_cat_info')
            // ->for(Brand::factory(), 'brand')
            ->create();

        // Make a GET request to the index endpoint
        $response = $this->getJson('/api/products');

        // Assert the response status is 200 OK
        $response->assertStatus(200);
    }

    /**
     * Test creating a new product.
     */
    // public function test_store(): void
    // {
    //     // Create related models
    //     $category = Category::factory()->create();
    //     $brand = Brand::factory()->create();

    //     // Data for the new product
    //     $data = [
    //         'name' => 'Test Product',
    //         'description' => 'This is a test product.',
    //         'price' => 99.99,
    //         'category_id' => $category->id,
    //         'brand_id' => $brand->id,
    //         'status' => 'active',
    //         'stock' => 20,
    //         'cat_id' => $category->id,
    //         'slug' => 'test-product',
    //         'title' => 'Test Product',
    //         'summary' => 'This is a test product.',
    //         'photo' => 'https://example.com/test-product.jpg',
    //     ];

    //     // Make a POST request to the store endpoint
    //     $response = $this->postJson('/api/products', $data);

    //     // Assert the response status is 201 Created
    //     $response->assertStatus(201);

    //     assert($response->json('status') == true);
    //     $this->assertDatabaseHas('products', [
    //         'title' => 'Test Product',
    //     ]);
        
    // }

}
