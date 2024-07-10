<?php

declare(strict_types=1);

namespace App\Livewire\Buttons;

use App\Models\BaseProduct;
use App\Services\Cart;
use Illuminate\View\View;
use Livewire\Component;

class AddToCart extends Component
{
    public BaseProduct $product;

    public function add(): void
    {
        /** @var Cart * */
        $cart = app(Cart::class);

        if ($cart->hasProduct($this->product)) {
            $cart->increment($this->product);
        } else {
            $cart->add($this->product, 1);
        }

        session()->flash('message', __('Product added to cart'));

        $this->dispatch('refresh-cart');
    }

    public function render(): View
    {
        return view('livewire.buttons.add-to-cart');
    }
}
