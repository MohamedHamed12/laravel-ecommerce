<?php
namespace Database\Factories;

use App\Models\Product;
use App\Models\Category;
use App\Models\Brand;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Log;
class ProductFactory extends Factory
{
    protected $model = Product::class;

    public function definition()
    {
        // Ensure at least one category and brand exist
        $category = Category::factory()->create();
        $brand = Brand::factory()->create();
        Log::debug($category);
        Log::debug($brand);

        return [
            'title' => $this->faker->word(),
            'slug' => $this->faker->slug(),
            'summary' => $this->faker->sentence(),
            // 'description' => $this->faker->paragraph(),
            'photo' => $this->faker->imageUrl(),
            // 'stock' => $this->faker->numberBetween(10, 100),
            // 'size' => $this->faker->randomElement(['S', 'M', 'L', 'XL']),
            // 'condition' => $this->faker->randomElement(['new', 'used']),
            // 'status' => $this->faker->randomElement(['active', 'inactive']),
            'price' => $this->faker->numberBetween(100, 1000),
            // 'discount' => $this->faker->numberBetween(0, 50),
            'is_featured' => $this->faker->boolean(),
            // 'cat_id' => $category->id,
            // 'child_cat_id' => null,
            // 'child_cat_id' => $this->faker->optional()->randomElement([Category::factory()->create()->id, null]),
            // 'brand_id' => $brand->id,
        ];
    }

    /**
     * Configure the model factory.
     *
     * @return $this
     */
    public function configure()
    {
        return $this->afterCreating(function (Product $product) {
            // Create reviews for the product
            // $product->getReview()->saveMany(
            //     \App\Models\Review::factory()->count(3)->make()
            // );
        });
    }
}