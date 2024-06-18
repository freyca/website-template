<?php

declare(strict_types=1);

namespace App\Livewire;

use App\Models\BaseProduct;
use App\Repositories\Cart\SessionCartRepository;
use App\Services\Cart;
use Illuminate\View\View;
use Livewire\Component;

class RemoveFromCart extends Component
{
    public BaseProduct $product;

    public function remove(): void
    {
        $cart = new Cart(new SessionCartRepository);
        $cart->remove($this->product);
    }

    public function render(): View
    {
        return view('livewire.remove-from-cart');
    }
}
