<?php

declare(strict_types=1);

namespace App\Livewire;

use App\Models\BaseProduct;
use App\Services\Cart;
use Illuminate\View\View;
use Livewire\Component;

class RemoveFromCart extends Component
{
    public BaseProduct $product;

    public function remove(): void
    {
        $cart = app(Cart::class);

        $cart->remove($this->product);

        session()->flash('message', __('Product deleted from cart'));

        $this->dispatch('refresh-cart');
    }

    public function render(): View
    {
        return view('livewire.remove-from-cart');
    }
}
