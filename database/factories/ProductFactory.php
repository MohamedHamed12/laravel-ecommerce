<?php

namespace Database\Factories;

use App\Models\Product;
use App\Models\Category;
use App\Models\Brand;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    protected $model = Product::class;

    public function definition()
    {
        return [
            'title' => $this->faker->word(),
            'slug' => $this->faker->slug(),
            'summary' => $this->faker->sentence(),
            'description' => $this->faker->paragraph(),
            'photo' => $this->faker->imageUrl(),
            'stock' => $this->faker->numberBetween(10, 100),
            'size' => $this->faker->randomElement(['S', 'M', 'L', 'XL']),
            'condition' => $this->faker->randomElement(['new', 'used']),
            'status' => $this->faker->randomElement(['active', 'inactive']),
            'price' => $this->faker->numberBetween(100, 1000),
            'discount' => $this->faker->numberBetween(0, 50),
            'is_featured' => $this->faker->boolean(),
            'cat_id' => Category::inRandomOrder()->first()->id, // Assume category exists
            'child_cat_id' => Category::inRandomOrder()->first()->id, // Optional child category
            'brand_id' => Brand::inRandomOrder()->first()->id, // Assume brand exists
        ];
    }
}
