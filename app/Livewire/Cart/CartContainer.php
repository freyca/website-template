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
        return view('livewire.cart.cart-container');
    }
}
