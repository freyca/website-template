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

    public bool $assemble_status = true;

    public bool $inCart;

    #[On('assemble-status-changed')]
    public function assembleStatusChanged(bool $assemble_status)
    {
        $this->assemble_status = $assemble_status;
    }

    #[On('refresh-cart')]
    public function render(): View
    {
        $cart = app(Cart::class);

        $this->inCart = $cart->hasProduct($this->product, $this->assemble_status);

        return view('livewire.product.product-buttons');
    }
}
