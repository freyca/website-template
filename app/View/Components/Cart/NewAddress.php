<?php

namespace App\View\Components\Cart;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class NewAddress extends Component
{
    public function __construct(public bool $shouldBeChecked) {}

    public function render(): View|Closure|string
    {
        return view('components.cart.new-address');
    }
}
