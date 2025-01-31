<?php

declare(strict_types=1);

namespace App\Livewire\Product;

use App\Models\BaseProduct;
use App\Models\Product;
use App\Models\ProductVariant;
use App\Services\Cart;
use Filament\Notifications\Notification;
use Illuminate\Support\Collection;
use Livewire\Component;

class ProductCartContainer extends Component
{
    public BaseProduct $product;

    public int $variant_id;

    public Collection $variants;

    public bool $in_cart;

    public bool $assemble_status;

    public int $productQuantity = 0;

    public function toggleAssemble()
    {
        $this->assemble_status = ! $this->assemble_status;

        return $this->assemble_status;
    }

    public function variantSelectionChanged(): void
    {
        /**
         * @var ProductVariant
         */
        $variant = ProductVariant::find($this->variant_id);

        $this->product = $variant;
    }

    public function add(): void
    {
        /** @var Cart * */
        $cart = app(Cart::class);

        $cart->add($this->product, 1, $this->assemble_status);

        Notification::make()->title(__('Product added correctly'))->success()->send();

        $this->dispatch('refresh-cart');
    }

    public function increment(): void
    {
        /** @var Cart * */
        $cart = app(Cart::class);

        $cart->add($this->product, 1, $this->assemble_status);

        Notification::make()->title(__('Product incremented'))->success()->send();

        $this->dispatch('refresh-cart');
    }

    public function decrement(): void
    {
        /** @var Cart * */
        $cart = app(Cart::class);

        $cart->add($this->product, -1, $this->assemble_status);

        Notification::make()->title(__('Product decremented'))->danger()->send();

        $this->dispatch('refresh-cart');
    }

    public function remove(): void
    {
        $cart = app(Cart::class);

        $cart->remove($this->product, $this->assemble_status);

        Notification::make()->title(__('Product removed from cart'))->danger()->send();

        $this->dispatch('refresh-cart');
    }

    public function render()
    {
        $cart = app(Cart::class);

        $this->setAssemblyStatus();
        $this->validateVariantProduct();

        $this->in_cart = $cart->hasProduct($this->product, $this->assemble_status);
        $this->productQuantity = $cart->getTotalQuantityForProduct($this->product, $this->assemble_status);

        return view('livewire.product.product-cart-container');
    }

    /**
     * Determines if product can be assebled
     */
    private function setAssemblyStatus(): void
    {
        if (! isset($this->assemble_status)) {
            $this->assemble_status = $this->product->can_be_assembled ? true : false;
        }
    }

    /**
     * If product has variants cannot be the selected product, needs to be a
     * variant
     */
    private function validateVariantProduct(): void
    {
        if (! is_a($this->product, Product::class)) {
            return;
        }

        if ($this->product->productVariants->count() !== 0) {
            $this->product = $this->product->productVariants->first();
        }
    }
}
