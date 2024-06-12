<?php

namespace Database\Factories;

use App\Enums\PaymentMethods;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Order>
 */
class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'purchase_cost' => fake()->randomFloat(100),
            'payment_method' => $this->getRandomPaymentMethod(),
            'payed' => fake()->boolean(70),
            'user_id' => User::inRandomOrder()->first()->id,
        ];
    }

    private function getRandomPaymentMethod(): string
    {
        $payment_methods = [];

        foreach (PaymentMethods::cases() as $case) {
            array_push($payment_methods, $case->name);
        }

        $rand = array_rand($payment_methods);

        return $payment_methods[$rand];
    }
}
