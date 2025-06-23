<?php

namespace App\DTO;

use App\Models\BaseProduct;
use App\Models\ProductVariant;

class OrderProductDTO
{
    /**
     * Private attributes are used as a "cache system"
     * This avoid repetitive queries to the database by querying this object
     */
    private float $price_without_discount;

    private ?float $price_with_discount;

    private ?float $price_when_user_owns_product;

    private int $ean13;

    private BaseProduct $product;

    private ?ProductVariant $product_variant;

    public function __construct(
        private int $orderable_id,
        private string $orderable_type,
        private ?int $product_variant_id,
        private float $unit_price,
        private ?float $assembly_price,
        private int $quantity,
        ProductVariant|BaseProduct $product,
    ) {
        $this->ean13 = $product->ean13;
        $this->price_with_discount = $product->price_with_discount;
        $this->price_without_discount = $product->price;
        $this->price_when_user_owns_product = ! isset($product->price_when_user_owns_product) ? null : $product->price_when_user_owns_product;
    }

    public function setQuantity(int $quantity): void
    {
        $this->quantity = $quantity;
    }

    /**
     * Getters
     */
    public function getProduct(): BaseProduct
    {
        if (! isset($this->product)) {
            $this->product = $this->orderable_type::find($this->orderable_id);
        }

        return $this->product;
    }

    public function getProductVariant(): ?ProductVariant
    {
        if (is_null($this->product_variant_id)) {
            return null;
        }

        if (! isset($this->product_variant)) {
            $this->product_variant = ProductVariant::find($this->product_variant_id);
        }

        return $this->product_variant;
    }

    public function priceWithoutDiscount(): float
    {
        return $this->price_without_discount;
    }

    public function priceWithDiscount(): ?float
    {
        return $this->price_with_discount;
    }

    public function priceWhenUserOwnsProduct(): ?float
    {
        return $this->price_when_user_owns_product;
    }

    public function ean13(): int
    {
        return $this->ean13;
    }

    public function orderableId(): int
    {
        return $this->orderable_id;
    }

    public function orderableType(): string
    {
        return $this->orderable_type;
    }

    public function productVariantId(): ?int
    {
        return $this->product_variant_id;
    }

    public function unitPrice(): float
    {
        return $this->unit_price;
    }

    public function assemblyPrice(): ?float
    {
        return $this->assembly_price;
    }

    public function quantity(): int
    {
        return $this->quantity;
    }
}
