<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

class CategoryFactory extends Factory
{
    protected $model = Category::class;

    public function definition()
    {
        return [
            'title' => $this->faker->word,
            'slug' => $this->faker->slug,
            'summary' => $this->faker->sentence,
            'photo' => $this->faker->imageUrl(),
            'is_parent' => $this->faker->boolean,
            'parent_id' => $this->faker->optional()->randomElement([null, 1, 2, 3]), // Assuming parent categories exist
            'added_by' => $this->faker->name,
            'status' => $this->faker->randomElement(['active', 'inactive']),
        ];
    }
}
