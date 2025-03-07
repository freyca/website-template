<?php

declare(strict_types=1);

namespace App\Repositories\ProductsWithDiscountPerPurchase;

use App\Models\ProductComplement;
use App\Models\ProductSparePart;

interface ProductsWithDiscountPerPurchaseInterface
{
    public function savePurchasedProducts(bool $force = false): void;

    public function addCartItem(int $ean13): void;

    public function deleteCartItem(int $ean13): void;

    public function hasItemToOfferDiscount(ProductComplement|ProductSparePart $product): bool;
}
