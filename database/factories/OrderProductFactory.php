<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\OrderProduct>
 */
class OrderProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $product = Product::inRandomOrder()->first();

        $price = match (true) {
            ! is_null($product->price_with_discount) => $product->price_with_discount,
            default => $product->price,
        };

        return [
            'product_id' => $product->id,
            'quantity' => rand(1, 10),
            'unit_price' => $price,
        ];
    }
}
