<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $price = fake()->randomFloat(2, 10);

        return [
            'name' => fake()->word(),
            'price' => $price,
            'price_with_discount' => $this->isProductDiscounted($price),
            'published' => fake()->boolean(75),
            'stock' => fake()->numberBetween(10, 100),
            'slogan' => fake()->text(50),
            'meta_description' => fake()->text(20),
            'short_description' => fake()->text(200),
            'description' => fake()->text(1000),
            'category_id' => Category::inRandomOrder()->first()->id,
        ];
    }

    private function isProductDiscounted(int $actual_price): ?float
    {
        if (fake()->randomNumber(1) % 2 === 0) {
            return fake()->randomFloat(2, 5, $actual_price - 2);
        }

        return null;
    }
}
