<?php

declare(strict_types=1);

namespace App\Repositories\Cart;

use App\Models\BaseProduct;
use Illuminate\Support\Collection;

interface CartRepositoryInterface
{
    public function add(BaseProduct $product, int $quantity): void;

    public function increment(BaseProduct $product): void;

    public function decrement(BaseProduct $product): void;

    public function remove(BaseProduct $product): void;

    public function getTotalQuantityForProduct(BaseProduct $product): int;

    public function getTotalCostforProduct(BaseProduct $product, bool $formatted = false): float|string;

    public function getTotalCostforProductWithoutDiscount(BaseProduct $product, bool $formatted = false): float|string;

    public function getTotalQuantity(): int;

    public function getTotalCost(bool $formatted = false): float|string;

    public function getTotalDiscount(bool $formatted = false): float|string;

    public function getTotalCostWithoutDiscount(bool $formatted = false): float|string;

    public function hasProduct(BaseProduct $product): bool;

    /**
     * @return Collection<string, array<string, BaseProduct|int>>
     */
    public function getCart(): Collection;

    public function isEmpty(): bool;

    public function clear(): void;
}
