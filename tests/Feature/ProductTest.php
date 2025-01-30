<?php

namespace Tests\Feature;

use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProductTest extends TestCase
{
    use RefreshDatabase;

    // public function test_can_get_all_products()
    // {
    //     Product::factory()->count(5)->create();
        
    //     $response = $this->getJson('/products');

    //     $response->assertStatus(200)
    //              ->assertJsonStructure([
    //                  'data' => [
    //                      '*' => ['id', 'title', 'slug', 'price', 'status', 'stock']
    //                  ]
    //              ]);
    // }

    // public function test_can_create_product()
    // {
    //     $productData = [
    //         "title" => "Test Product",
    //         "slug" => "test-product",
    //         "cat_id" => 1,
    //         "price" => 199.99,
    //         "status" => "active",
    //         "stock" => 10
    //     ];

    //     $response = $this->postJson('/products', $productData);

    //     $response->assertStatus(201)
    //              ->assertJson([
    //                  'status' => true,
    //                  'message' => 'Product created successfully.'
    //              ]);
    // }

    // public function test_can_get_single_product()
    // {
    //     $product = Product::factory()->create();

    //     $response = $this->getJson('/products/' . $product->id);

    //     $response->assertStatus(200)
    //              ->assertJson([
    //                  'id' => $product->id,
    //                  'title' => $product->title
    //              ]);
    // }

    // public function test_can_update_product()
    // {
    //     $product = Product::factory()->create();

    //     $updateData = ["title" => "Updated Product"];

    //     $response = $this->putJson('/products/' . $product->id, $updateData);

    //     $response->assertStatus(200)
    //              ->assertJson([
    //                  'status' => true,
    //                  'message' => 'Product updated successfully.'
    //              ]);

    //     $this->assertDatabaseHas('products', ['title' => 'Updated Product']);
    // }

    // public function test_can_delete_product()
    // {
    //     $product = Product::factory()->create();

    //     $response = $this->deleteJson('/products/' . $product->id);

    //     $response->assertStatus(200)
    //              ->assertJson([
    //                  'status' => true,
    //                  'message' => 'Product deleted successfully.'
    //              ]);

    //     $this->assertDatabaseMissing('products', ['id' => $product->id]);
    // }
}
