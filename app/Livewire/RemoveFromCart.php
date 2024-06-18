<?php

declare(strict_types=1);

namespace App\Livewire;

use App\Models\BaseProduct;
use App\Repositories\Cart\SessionCartRepository;
use App\Services\Cart;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;
use Illuminate\View\View;
use Livewire\Component;

class RemoveFromCart extends Component
{
    public BaseProduct $product;

    public function remove(): RedirectResponse|Redirector|null
    {
        $cart = new Cart(new SessionCartRepository);
        $cart->remove($this->product);

        session()->flash('message', 'Product deleted from cart');

        $referer = strval(request()->header('Referer'));
        if (str_ends_with($referer, 'carrito')) {
            return redirect($referer);
        }

        return null;
    }

    public function render(): View
    {
        return view('livewire.remove-from-cart');
    }
}
