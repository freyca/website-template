<?php

namespace App\Livewire\Product;

use App\Models\ProductVariant;
use App\Models\BaseProduct;
use App\Services\Cart;
use Illuminate\View\View;
use Livewire\Attributes\On;
use Livewire\Component;

class AddToCartButtons extends Component
{
    public BaseProduct $product;

    public bool $inCart;

    #[On('variant-selection-changed')]
    public function variantSelectionChanged(int $variant_id): void
    {
        /**
         * @var ProductVariant
         */
        $variant = ProductVariant::find($variant_id);

        $this->product = $variant;
    }

    #[On('refresh-cart')]
    public function render(): View
    {
        $cart = app(Cart::class);

        $this->inCart = $cart->hasProduct($this->product);

        return view('livewire.product.product-variant-add-to-cart-buttons');
    }
}
