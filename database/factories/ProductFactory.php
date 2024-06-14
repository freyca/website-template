<?php

namespace Database\Factories;

use App\Models\Category;
use Database\Traits\WithProductDiscounts;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
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
            'name' => fake()->unique()->catchPhrase(),
            'price' => $price,
            'price_with_discount' => $this->isProductDiscounted($price),
            'published' => fake()->boolean(75),
            'stock' => fake()->numberBetween(10, 100),
            'slogan' => fake()->realText(50),
            'meta_description' => fake()->realText(20),
            'short_description' => fake()->realText(200),
            'description' => fake()->realText(1000),
            'category_id' => Category::inRandomOrder()->first()->id,
            'main_image' => 'product-images/sample-image.png',
            'images' => [
                'product-images/sample-image.png',
                'product-images/sample-image.png',
            ],
        ];
    }
}
