<?php

namespace Database\Factories;

use App\Models\Product;
use App\Models\Category;
use App\Models\Brand;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;


    
class ProductFactory extends Factory
{
    protected $model = Product::class;

    public function definition()
    {
        // Get all files from the folder
       
        $category = Category::factory()->create();
        $brand = Brand::factory()->create();
        return [
            'title' => $this->faker->word(),
            'slug' => $this->faker->slug(),
            'summary' => $this->faker->sentence(),
            // 'description' => $this->faker->paragraph(),
            'photo' =>  $this->getRandomImage(),
            'stock' => $this->faker->numberBetween(10, 100),
            // 'size' => $this->faker->randomElement(['S', 'M', 'L', 'XL']),
            // 'condition' => $this->faker->randomElement(['new', 'used']),
            'status' => $this->faker->randomElement(['active', 'inactive']),
            'price' => $this->faker->numberBetween(100, 1000),
            // 'discount' => $this->faker->numberBetween(0, 50),
            // 'is_featured' => $this->faker->boolean(),
            'cat_id' => $category->id,
            // Additional fields for category, brand can go here
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





public function getRandomImage()
{
    $files = File::allFiles('/workspaces/php-mariadb/data/products');

    // Filter for image files (jpg, jpeg, png, gif, svg)
    $imageFiles = array_filter($files, function ($file) {
        return in_array($file->getExtension(), ['jpg', 'jpeg', 'png', 'gif', 'svg']);
    });

    if (count($imageFiles) > 0) {
        // Pick a random image from the filtered list
        $randomFile = $imageFiles[array_rand($imageFiles)];

        // Get the filename and store the image in the public storage
        $newPath = 'products/' . $randomFile->getFilename();

        // Ensure the directory exists before storing
        Storage::disk('public')->makeDirectory('products');

        // Store the image in storage/app/public/products
        Storage::disk('public')->put($newPath, File::get($randomFile));

        return $newPath;
    }

    // Fallback in case no image is found
    return null;
}

}
