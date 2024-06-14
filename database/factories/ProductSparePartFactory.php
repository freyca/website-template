<?php

namespace Database\Factories;

use Database\Traits\WithProductDiscounts;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ProductSparePart>
 */
class ProductSparePartFactory extends Factory
{
    use WithProductDiscounts;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $price = fake()->randomFloat(2, 10, 3000);

        return [
            'name' => fake()->word(),
            'price' => $price,
            'price_with_discount' => $this->isProductDiscounted($price),
            'price_when_user_owns_product' => $price * 0.8,
            'published' => fake()->boolean(75),
            'stock' => fake()->numberBetween(10, 100),
            'slogan' => fake()->text(50),
            'meta_description' => fake()->text(20),
            'short_description' => fake()->text(200),
            'description' => fake()->text(1000),
        ];
    }
}
