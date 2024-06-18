<?php

declare(strict_types=1);

namespace App\Livewire;

use App\Models\BaseProduct;
use App\Repositories\Cart\SessionCartRepository;
use App\Services\Cart;
use Illuminate\View\View;
use Livewire\Component;

class AddToCart extends Component
{
    public BaseProduct $product;

    public function add(): void
    {
        $cart = new Cart(new SessionCartRepository);
        $cart->add($this->product, 1);
    }

    public function render(): View
    {
        return view('livewire.add-to-cart');
    }
}
