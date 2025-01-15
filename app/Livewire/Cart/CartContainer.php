<?php

declare(strict_types=1);

namespace App\Livewire\Cart;

use App\Services\Cart;
use Illuminate\View\View;
use Livewire\Attributes\On;
use Livewire\Component;

class CartContainer extends Component
{
    #[On('refresh-cart')]
    public function render(): string|View
    {
        /** @var Cart */
        $cart = app(Cart::class);

        if ($cart->getTotalQuantity() === 0) {
            return <<<'blade'
            <span>
            </span>

        blade;
        }

        return view('livewire.cart.cart-container');
    }
}
