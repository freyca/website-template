<?php

declare(strict_types=1);

namespace App\View\Components;

use App\Models\BaseProduct;
use App\Services\Cart;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class showProductInCart extends Component
{
    public function __construct(
        public BaseProduct $product,
        public int $quantity,
        public Cart $cart,
    ) {
    }

    public function render(): View
    {
        return view('components.show-product-in-cart');
    }
}
