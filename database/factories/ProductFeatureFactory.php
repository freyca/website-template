<?php

namespace Database\Factories;

use App\Enums\ProductFeatureFamily;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ProductFeatures>
 */
class ProductFeatureFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->unique()->catchPhrase(),
            'family' => $this->getRandomFamily(),
            'description' => fake()->realText(1000),
        ];
    }

    private function getRandomFamily(): string
    {
        $feature_families = [];

        foreach (ProductFeatureFamily::cases() as $case) {
            array_push($feature_families, $case->value);
        }

        return fake()->randomElement($feature_families);
    }
}
