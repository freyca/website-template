<?php

namespace Database\Factories;

use App\Enums\AddressType;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Address>
 */
class AddressFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'address_type' => $this->getRandomAddressType(),
            'name' => fake()->name(),
            'surname' => fake()->lastName(),
            'financial_number' => fake()->randomNumber(9, true) .  fake()->randomLetter(),
            'phone' => fake()->phoneNumber(),
            'address' => fake()->address(),
            'city' => fake()->city(),
            'state' => fake()->state(),
            'zip_code' => fake()->numberBetween(10000, 99999),
            'country' => fake()->country(),
        ];
    }

    private function getRandomAddressType(): AddressType
    {
        $address_type = [];

        foreach (AddressType::cases() as $case) {
            array_push($address_type, $case);
        }

        return fake()->randomElement($address_type);
    }
}
