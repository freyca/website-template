<?php

declare(strict_types=1);

namespace App\Repositories\Cart;

use App\Models\BaseProduct;
use Illuminate\Support\Collection;

interface CartRepositoryInterface
{
    public function add(BaseProduct $product, int $quantity, bool $assemble): bool;

    public function remove(BaseProduct $product, bool $assemble): void;

    public function getTotalQuantityForProduct(BaseProduct $product, bool $assemble): int;

    public function getTotalCostforProduct(BaseProduct $product, bool $assemble, bool $formatted = false): float|string;

    public function getTotalCostforProductWithoutDiscount(BaseProduct $product, bool $assemble, bool $formatted = false): float|string;

    public function getTotalQuantity(): int;

    public function getTotalCost(bool $formatted = false): float|string;

    public function getTotalCostWithoutTaxes(bool $formatted = false): float|string;

    public function getTotalDiscount(bool $formatted = false): float|string;

    public function getTotalCostWithoutDiscount(bool $formatted = false): float|string;

    public function hasProduct(BaseProduct $product, bool $assemble): bool;

    public function canBeIncremented(BaseProduct $product): bool;

    /**
     * @return Collection<string, array<string, BaseProduct|int|bool>>
     */
    public function getCart(): Collection;

    public function isEmpty(): bool;

    public function clear(): void;
}
