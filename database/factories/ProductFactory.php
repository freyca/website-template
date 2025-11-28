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
        $mandatory_assembly = false;
        $assembly_price = 0;

        $can_be_assembled = fake()->boolean(70);

        if ($can_be_assembled === true) {
            $mandatory_assembly = fake()->boolean();
            $assembly_price = fake()->randomFloat(2, 50, 500);
        }

        return [
            'name' => fake()->unique()->catchPhrase(),
            'ean13' => fake()->unique()->ean13(),
            'price' => $price,
            'price_with_discount' => $this->isProductDiscounted($price),
            'published' => fake()->boolean(75),
            'stock' => fake()->numberBetween(10, 100),
            'can_be_assembled' => $can_be_assembled,
            'mandatory_assembly' => $mandatory_assembly,
            'assembly_price' => $assembly_price,
            'category_id' => Category::factory(),
            'main_image' => 'product-images/sample-image.png',
        ];
    }
}
