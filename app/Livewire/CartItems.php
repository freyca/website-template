<?php

declare(strict_types=1);

namespace App\Livewire;

use App\Services\Cart;
use Illuminate\Support\Collection;
use Illuminate\View\View;
use Livewire\Attributes\On;
use Livewire\Component;

class CartItems extends Component
{
    /**
     * @var Collection<string, array<string, \App\Models\BaseProduct|int>>
     */
    public Collection $cartItems;

    #[On('refresh-cart')]
    public function setCartItems(): void
    {
        /** @var Cart */
        $cart = app(Cart::class);

        $this->cartItems = $cart->getCart();
    }

    public function render(): View
    {
        return view('livewire.cart-items');
    }
}
