<?php

declare(strict_types=1);

namespace App\Livewire\Cart;

use App\Models\BaseProduct;
use Illuminate\View\View;
use Livewire\Attributes\On;
use Livewire\Component;

class ProductCard extends Component
{
    public BaseProduct $product;

    #[On('refresh-cart')]
    public function render(): View
    {
        return view('livewire.cart.product-card');
    }
}
