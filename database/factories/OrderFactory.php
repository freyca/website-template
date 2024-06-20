<?php

namespace Database\Factories;

use App\Enums\OrderStatus;
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
        $user = User::inRandomOrder()->first();

        return [
            'purchase_cost' => fake()->randomFloat(2, 10, 3000),
            'payment_method' => $this->getRandomPaymentMethod(),
            'status' => $this->getRandomOrderStatus(),
            'user_id' => $user->id,
            'user_metadata_id' => $user->userMetadata->random()->id,
        ];
    }

    private function getRandomPaymentMethod(): string
    {
        $payment_methods = [];

        foreach (PaymentMethods::cases() as $case) {
            array_push($payment_methods, $case->value);
        }

        return fake()->randomElement($payment_methods);
    }

    private function getRandomOrderStatus(): OrderStatus
    {
        $order_status = [];

        foreach (OrderStatus::cases() as $case) {
            array_push($order_status, $case);
        }

        return fake()->randomElement($order_status);
    }
}
