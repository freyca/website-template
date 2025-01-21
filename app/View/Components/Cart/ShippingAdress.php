<?php

namespace App\View\Components\Cart;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use Illuminate\Database\Eloquent\Collection;

class ShippingAdress extends Component
{
    public $adresses;

    public function __construct()
    {
        $this->adresses  = collect();

        $user = auth()->user();
        if ($user !== null) {
            $this->adresses = $user->Address;
        }
    }

    public function render(): View|Closure|string
    {
        return view('components.cart.shipping-adress');
    }
}
