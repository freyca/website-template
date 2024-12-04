<?php

namespace App\Livewire\Product;

use App\Models\ProductVariant;
use App\Services\Cart;
use Illuminate\View\View;
use Livewire\Attributes\On;
use Livewire\Component;

class ProductVariantAddToCartButtons extends Component
{
    public ProductVariant $variant;

    public bool $inCart;

    #[On('variant-selection-changed')]
    public function variantSelectionChanged(int $variant_id): void
    {
        /**
         * @var ProductVariant
         */
        $variant = ProductVariant::find($variant_id);

        $this->variant = $variant;
    }

    #[On('refresh-cart')]
    public function render(): View
    {
        $cart = app(Cart::class);

        $this->inCart = $cart->hasProduct($this->variant);

        return view('livewire.product.product-variant-add-to-cart-buttons');
    }
}
