<?php

declare(strict_types=1);

namespace App\Livewire;

use Illuminate\View\View;
use Livewire\Attributes\On;
use Livewire\Component;

class CartItems extends Component
{
    #[On('refresh-cart')]
    public function setCartItems(): void
    {
    }

    public function render(): View
    {
        return view('livewire.cart-items');
    }
}
