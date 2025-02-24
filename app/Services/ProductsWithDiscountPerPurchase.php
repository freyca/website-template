<?php

namespace App\Services;

use App\Models\ProductComplement;
use App\Models\ProductSparePart;
use App\Repositories\ProductsWithDiscountPerPurchase\ProductsWithDiscountPerPurchaseInterface;

class ProductsWithDiscountPerPurchase implements ProductsWithDiscountPerPurchaseInterface
{
    public function __construct(private readonly ProductsWithDiscountPerPurchaseInterface $repository) {}

    public function savePurchasedProducts(bool $force = false): void
    {
        $this->repository->savePurchasedProducts($force);
    }

    public function addCartItem(int $ean13): void
    {
        $this->repository->savePurchasedProducts($ean13);
    }

    public function deleteCartItem(int $ean13): void
    {
        $this->repository->savePurchasedProducts($ean13);
    }

    public function hasItemToOfferDiscount(ProductComplement|ProductSparePart $product): bool
    {
        return $this->repository->hasItemToOfferDiscount($product);
    }
}
