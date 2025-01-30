<?php

namespace Tests\Feature;

use App\Models\Brand;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Database\Seeders\BrandSeeder;
class BrandTest extends TestCase
{
    use RefreshDatabase;

 
   public function it_can_create_brands()
    {
        // Seed the brands
        $this->seed(BrandSeeder::class);

        // Check if the brands exist in the database
        $this->assertDatabaseHas('brands', [
            'title' => 'Adidas',
            'slug' => 'adidas',
            'status' => 'active',
        ]);

        $this->assertDatabaseHas('brands', [
            'title' => 'Nike',
            'slug' => 'nike',
            'status' => 'active',
        ]);
    }
    public function test_can_create_brand()
    {
        $brandData = ["title" => "Test Brand" , "slug" => "test-brand" , "status" => "active"];

        $response = $this->postJson('/api/brands', $brandData);

        $response->assertStatus(201)
                 ->assertJson([
                     'status' => true,
                     'message' => 'Brand created successfully.'
                 ]);
    }

    public function test_can_get_single_brand()
    {
        $brand = Brand::factory()->create();

        $response = $this->getJson('/api/brands/' . $brand->id);

        $response->assertStatus(200)
                 ->assertJson(['id' => $brand->id, 'title' => $brand->title, 'slug' => $brand->slug, 'status' => $brand->status]);
    }

}
