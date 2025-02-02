<?php

namespace Tests\Feature;

use App\Models\Category;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Database\Seeders\CategorySeeder;

class CategoryTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test that we can get all categories.
     *
     * @return void
     */
    public function test_can_get_all_categories()
    {
        $this->seed(CategorySeeder::class);

        // Check if the categories exist in the database
        $this->assertDatabaseHas('categories', [
            'title' => 'Men\'s Fashion',
            'slug' => 'mens-fashion',
            'status' => 'active',
        ]);

        $this->assertDatabaseHas('categories', [
            'title' => 'T-shirt\'s',
            'slug' => 't-shirts',
            'parent_id' => 1, // This is a child category with parent_id pointing to Men’s Fashion
        ]);


        $response = $this->getJson('/api/categories');  // Change to the actual API route
        $response->assertStatus(200);
    }

    public function test_can_create_category()
    {
        $response = $this->postJson('/api/categories', [
            'title' => 'New Category',
            'slug' => 'new-category',
            'status' => 'active',
        ]);

        $response->assertStatus(201);
        $response->assertJsonFragment(['title' => 'New Category']);
    }
    
    // public function test_can_delete_category()
    // {
    //     $category = Category::factory()->create([
    //         'title' => 'Women\'s Fashion',
    //         'added_by' => null,
    //     ]);
    //     $response = $this->deleteJson("api/categories/{$category->id}");
    //     $response->assertStatus(200);
    // }

    // public function test_can_update_category()
    // {

    //  $category = Category::factory()->create([
    //         'title' => 'Women\'s Fashion',
    //         'added_by' => null,
    //     ]);

    //     $response = $this->patchJson("api/categories/{$category->id}", [
    //         'title' => 'Updated Category',
    //     ]);
    //     $response->assertStatus(200);
    //     $response->assertJsonFragment(['title' => 'Updated Category']);
    // }
}
