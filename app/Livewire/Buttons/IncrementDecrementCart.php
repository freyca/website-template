<?php

declare(strict_types=1);

namespace App\Livewire\Buttons;

use App\Models\BaseProduct;
use App\Models\ProductVariant;
use App\Services\Cart;
use Filament\Notifications\Notification;
use Illuminate\View\View;
use Livewire\Component;
use Livewire\Attributes\On;

class IncrementDecrementCart extends Component
{
    public BaseProduct $product;

    public int $productQuantity = 0;

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
        $cart = app(Cart::class);

        $cart->remove($this->product);

        Notification::make()->title(__('Product removed from cart'))->danger()->send();

        $this->dispatch('refresh-cart');
    }

    #[On('variant-selection-changed')]
    public function variantChanged($variant_id)
    {
        $this->product = ProductVariant::find($variant_id);
    }

    public function render(): View
    {
        /** @var Cart */
        $cart = app(Cart::class);

        $this->productQuantity = $cart->getTotalQuantityForProduct($this->product);

        return view('livewire.buttons.increment-decrement-cart');
    }
}
