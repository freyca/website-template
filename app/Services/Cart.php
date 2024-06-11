<?php

namespace App\Services;

use App\Models\Product;
use App\Repositories\Cart\CartRepositoryInterface;
use Illuminate\Support\Collection;

final readonly class Cart
{
    public function __construct(private readonly CartRepositoryInterface $repository)
    {
    }

    public function add(Product $product, int $quantity): void
    {
        $this->repository->add($product, $quantity);
    }

    /**
     * @throws \Exception
     */
    public function increment(Product $product): void
    {
        $this->repository->increment($product);
    }

    public function decrement(int $productId): void
    {
        $this->repository->decrement($productId);
    }

    public function remove(int $productId): void
    {
        $this->repository->remove($productId);
    }

    public function getTotalQuantityForProduct(Product $product): int
    {
        return $this->repository->getTotalQuantityForProduct($product);
    }

    public function getTotalCostforProduct(Product $product, bool $formatted = false): float|string
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

    public function hasProduct(Product $product): bool
    {
        return $this->repository->hasProduct($product);
    }

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
}
