<?php

namespace Database\Factories;

use App\Enums\OrderStatus;
use App\Enums\PaymentMethod;
use App\Models\Address;
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
            'user_id' => User::factory(),
            'purchase_cost' => fake()->randomFloat(2, 10, 3000),
            'payment_method' => $this->getRandomPaymentMethod(),
            'status' => $this->getRandomOrderStatus(),
        ];
    }

    public function configure()
    {
        return $this->afterCreating(function ($order) {
            // Auto-create a shipping address if the order doesn't have one
            if (!$order->shippingAddress) {
                $order->shippingAddress()->create([
                    'user_id' => $order->user_id,
                    'type' => 'shipping',
                    'name' => fake()->name(),
                    'address' => fake()->address(),
                    'phone' => fake()->phoneNumber(),
                    'city' => fake()->city(),
                    'province' => fake()->state(),
                    'postal_code' => fake()->postcode(),
                    'country' => 'ES',
                ]);
            }
        });
    }

    private function getRandomPaymentMethod(): string
    {
        return fake()->randomElement(
            array_map(fn($case) => $case->value, PaymentMethod::cases())
        );
    }

    private function getRandomOrderStatus(): OrderStatus
    {
        return fake()->randomElement(OrderStatus::cases());
    }
}
