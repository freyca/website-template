<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\BaseProduct;
use App\Repositories\Cart\CartRepositoryInterface;
use Illuminate\Support\Collection;

final class Cart implements CartRepositoryInterface
{
    public function __construct(
        private readonly CartRepositoryInterface $repository,
    ) {}

    public function add(BaseProduct $product, int $quantity, bool $assemble): void
    {
        try {
            $this->repository->add($product, $quantity, $assemble);
        } catch (\Throwable $th) {
            return;
        }
    }

    public function remove(BaseProduct $product, bool $assemble): void
    {
        $this->repository->remove($product, $assemble);
    }

    public function getTotalQuantityForProduct(BaseProduct $product, bool $assemble): int
    {
        return $this->repository->getTotalQuantityForProduct($product, $assemble);
    }

    public function getTotalCostforProduct(BaseProduct $product, bool $assemble, bool $formatted = false): float|string
    {
        return $this->repository->getTotalCostforProduct($product, $assemble, $formatted);
    }

    public function getTotalCostforProductWithoutDiscount(BaseProduct $product, bool $assemble, bool $formatted = false): float|string
    {
        return $this->repository->getTotalCostforProductWithoutDiscount($product, $assemble, $formatted);
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

    public function hasProduct(BaseProduct $product, bool $assemble_status): bool
    {
        return $this->repository->hasProduct($product, $assemble_status);
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
