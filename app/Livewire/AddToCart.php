<?php

declare(strict_types=1);

namespace App\Livewire;

use App\Models\BaseProduct;
use App\Services\Cart;
use Illuminate\View\View;
use Livewire\Component;

class AddToCart extends Component
{
    public BaseProduct $product;

    public function add(): void
    {
        $cart = app(Cart::class);

        $cart->add($this->product, 1);

        session()->flash('message', __('Product added to cart'));

        $this->dispatch('refresh-cart');
    }

    public function render(): View
    {
        return view('livewire.add-to-cart');
    }
}
