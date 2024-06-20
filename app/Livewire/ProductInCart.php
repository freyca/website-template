<?php

declare(strict_types=1);

namespace App\Livewire;

use App\Models\BaseProduct;
use App\Services\Cart;
use Illuminate\View\View;
use Livewire\Component;

class ProductInCart extends Component
{
    public BaseProduct $product;

    public function increment(): void
    {
        /** @var Cart * */
        $cart = app(Cart::class);

        $cart->increment($this->product);

        session()->flash('message', __('Product incremented'));

        $this->dispatch('refresh-cart');
    }

    public function decrement(): void
    {
        /** @var Cart * */
        $cart = app(Cart::class);

        $cart->decrement($this->product);

        session()->flash('message', __('Product decremented'));

        $this->dispatch('refresh-cart');
    }

    public function remove(): void
    {
        /** @var Cart * */
        $cart = app(Cart::class);

        $cart->remove($this->product);

        session()->flash('message', __('Product removed from cart'));

        $this->dispatch('refresh-cart');
    }

    public function render(): View
    {
        return view('livewire.product-in-cart');
    }
}
