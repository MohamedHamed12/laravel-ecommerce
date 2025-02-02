<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;

class CategoryFactory extends Factory
{
    protected $model = Category::class;

    public function definition()
    {
        $user = User::factory()->create();
        return [
            'title' => $this->faker->word,
            'slug' => $this->faker->slug,
            'summary' => $this->faker->sentence,
            'photo' => $this->faker->imageUrl(),
            'is_parent' => $this->faker->boolean,
            'parent_id' => null,
            // 'parent_id' => $this->faker->optional()->randomElement([null, 1, 2, 3]), // Assuming parent categories exist
            'added_by' => $user->id,
            'status' => $this->faker->randomElement(['active', 'inactive']),
        ];
    }
}
