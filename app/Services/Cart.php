<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\BaseProduct;
use App\Repositories\Cart\CartRepositoryInterface;
use Illuminate\Support\Collection;

final class Cart
{
    public function __construct(
        private readonly CartRepositoryInterface $repository,
    ) {}

    public function add(BaseProduct $product, int $quantity): void
    {
        $this->repository->add($product, $quantity);
    }

    /**
     * @throws \Exception
     */
    public function increment(BaseProduct $product): bool
    {
        try {
            $this->repository->increment($product);

            return true;
        } catch (\Throwable $th) {
            return false;
        }
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

    public function getTotalCostforProductWithoutDiscount(BaseProduct $product, bool $formatted = false): float|string
    {
        return $this->repository->getTotalCostforProductWithoutDiscount($product, $formatted);
    }

    public function getTotalQuantity(): int
    {
        return $this->repository->getTotalQuantity();
    }

    public function getTotalCost(bool $formatted = false): float|string
    {
        return $this->repository->getTotalCost($formatted);
    }

    public function getTotalCostWithoutTaxes(bool $formatted = false): float|string
    {
        return $this->repository->getTotalCostWithoutTaxes($formatted);
    }

    public function getTotalDiscount(bool $formatted = false): float|string
    {
        return $this->repository->getTotalDiscount($formatted);
    }

    public function getTotalCostWithoutDiscount(bool $formatted = false): float|string
    {
        return $this->repository->getTotalCostWithoutDiscount($formatted);
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
}
