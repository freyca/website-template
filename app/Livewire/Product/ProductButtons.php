<?php

declare(strict_types=1);

namespace App\Livewire\Product;

use App\Models\BaseProduct;
use App\Services\Cart;
use Illuminate\View\View;
use Livewire\Attributes\On;
use Livewire\Component;

class ProductButtons extends Component
{
    public BaseProduct $product;

    public bool $inCart;

    #[On('refresh-cart')]
    public function render(): View
    {
        $cart = app(Cart::class);

        $this->inCart = $cart->hasProduct($this->product);

        return view('livewire.product.product-buttons');
    }
}
