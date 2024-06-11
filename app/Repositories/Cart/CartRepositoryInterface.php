<?php

namespace App\Repositories\Cart;

use App\Models\Product;
use Illuminate\Support\Collection;

interface CartRepositoryInterface
{
    public function add(Product $product, int $quantity): void;

    public function increment(Product $product): void;

    public function decrement(int $productId): void;

    public function remove(int $productId): void;

    public function getTotalQuantityForProduct(Product $product): int;

    public function getTotalCostforProduct(Product $product, bool $formatted = false): float|string;

    public function getTotalQuantity(): int;

    public function getTotalCost(bool $formatted = false): float|string;

    public function hasProduct(Product $product): bool;

    public function getCart(): Collection;

    public function isEmpty(): bool;

    public function clear(): void;
}
