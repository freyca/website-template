<?php

namespace Database\Factories;

use App\Models\Product;
use App\Models\ProductComplement;
use App\Models\ProductSparePart;
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
        $class_names = [
            Product::class,
            ProductComplement::class,
            ProductSparePart::class,
        ];

        $rand_class = array_rand($class_names);
        $product = $class_names[$rand_class]::inRandomOrder()->first();
        $variants = $product?->productVariants;

        if ($variants !== null && count($variants) !== 0) {
            $variant = $variants->random();
        }

        $price = match (true) {
            isset($variant) => (! is_null($variant->price_with_discount)) ? $variant->price_with_discount : $variant->price,
            ! is_null($product->price_with_discount) => $product->price_with_discount,
            default => $product->price,
        };

        return [
            'orderable_id' => $product->id,
            'orderable_type' => $class_names[$rand_class],
            'product_variant_id' => isset($variant) ? $variant->id : null,
            'quantity' => rand(1, 10),
            'unit_price' => $price,
            'assembly_price' => $product->assembly_price,
        ];
    }
}
