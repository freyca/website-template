<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Category>
 */
class CategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->word(),
            'slogan' => fake()->text(30),
            'description' => fake()->text(500),
            'big_image' => '/storage/category-images/sample-image.png',
            'small_image' => '/storage/category-images/sample-image.png',
        ];
    }
}
