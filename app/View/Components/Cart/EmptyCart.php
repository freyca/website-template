<?php

namespace App\View\Components\Cart;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class EmptyCart extends Component
{
    public function __construct() {}

    public function render(): View|Closure|string
    {
        return view('components.empty-cart');
    }
}
