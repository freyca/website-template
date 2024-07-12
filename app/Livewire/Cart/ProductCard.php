<?php

declare(strict_types=1);

namespace App\Livewire\Cart;

use App\Models\BaseProduct;
use App\Services\Cart;
use Filament\Notifications\Notification;
use Illuminate\View\View;
use Livewire\Component;

class ProductCard extends Component
{
    public BaseProduct $product;

    public function increment(): void
    {
        /** @var Cart * */
        $cart = app(Cart::class);

        $cart->increment($this->product);

        Notification::make()->title(__('Product incremented'))->success()->send();

        $this->dispatch('refresh-cart');
    }

    public function decrement(): void
    {
        /** @var Cart * */
        $cart = app(Cart::class);

        $cart->decrement($this->product);

        Notification::make()->title(__('Product decremented'))->danger()->send();

        $this->dispatch('refresh-cart');
    }

    public function remove(): void
    {
        /** @var Cart * */
        $cart = app(Cart::class);

        $cart->remove($this->product);

        Notification::make()->title(__('Product removed from cart'))->danger()->send();

        $this->dispatch('refresh-cart');
    }

    public function render(): View
    {
        return view('livewire.cart.product-card');
    }
}
