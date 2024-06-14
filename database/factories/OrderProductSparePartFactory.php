<?php

namespace Database\Factories;

use App\Models\ProductSparePart;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class OrderProductSparePartFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $product = ProductSparePart::inRandomOrder()->first();

        $price = match (true) {
            ! is_null($product->price_with_discount) => $product->price_with_discount,
            default => $product->price,
        };

        return [
            'product_spare_part_id' => $product->id,
            'quantity' => rand(1, 10),
            'unit_price' => $price,
        ];
    }
}
