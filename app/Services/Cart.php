<?php

declare(strict_types=1);

namespace App\Services;

use App\Enums\OrderStatus;
use App\Enums\PaymentMethod;
use App\Models\BaseProduct;
use App\Models\Order;
use App\Models\User;
use App\Repositories\Cart\CartRepositoryInterface;
use Illuminate\Support\Collection;

final readonly class Cart
{
    public function __construct(private readonly CartRepositoryInterface $repository)
    {
    }

    public function add(BaseProduct $product, int $quantity): void
    {
        $this->repository->add($product, $quantity);
    }

    /**
     * @throws \Exception
     */
    public function increment(BaseProduct $product): void
    {
        $this->repository->increment($product);
    }

    public function decrement(BaseProduct $product): void
    {
        $this->repository->decrement($product);
    }

    public function remove(BaseProduct $product): void
    {
        $this->repository->remove($product);
    }

    public function getTotalQuantityForProduct(BaseProduct $product): int
    {
        return $this->repository->getTotalQuantityForProduct($product);
    }

    public function getTotalCostforProduct(BaseProduct $product, bool $formatted = false): float|string
    {
        return $this->repository->getTotalCostforProduct($product, $formatted);
    }

    public function getTotalQuantity(): int
    {
        return $this->repository->getTotalQuantity();
    }

    public function getTotalCost(bool $formatted = false): float|string
    {
        return $this->repository->getTotalCost($formatted);
    }

    public function hasProduct(BaseProduct $product): bool
    {
        return $this->repository->hasProduct($product);
    }

    /**
     * @return Collection<string, array<string, BaseProduct|int>>
     */
    public function getCart(): Collection
    {
        return $this->repository->getCart();
    }

    public function isEmpty(): bool
    {
        return $this->repository->isEmpty();
    }

    public function clear(): void
    {
        $this->repository->clear();
    }

    public function buildOrder(PaymentMethod $paymentMethod, User $user): Order
    {
        $order = new Order();
        $order->purchase_cost = (float) $this->getTotalCost();
        $order->payment_method = $paymentMethod;
        $order->status = OrderStatus::New;
        $order->user_id = $user->id;

        $cartProducts = $this->getCart();

        foreach ($cartProducts as $index => $cartProduct) {
            $this->associateProductToOrder($cartProduct);
        }

        $order->save();

        /** @var Order */
        return $order->fresh();
    }

    private function associateProductToOrder(mixed $product): void
    {
        //
    }
}
