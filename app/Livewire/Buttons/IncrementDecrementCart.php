<?php

declare(strict_types=1);

namespace App\Livewire\Buttons;

use App\Models\BaseProduct;
use App\Models\ProductVariant;
use App\Services\Cart;
use Filament\Notifications\Notification;
use Illuminate\View\View;
use Livewire\Attributes\On;
use Livewire\Component;

class IncrementDecrementCart extends Component
{
    public BaseProduct $product;

    public int $productQuantity = 0;

    public bool $assemble;

    public function increment(): void
    {
        /** @var Cart * */
        $cart = app(Cart::class);

        $cart->add($this->product, 1, $this->assemble);

        Notification::make()->title(__('Product incremented'))->success()->send();

        $this->dispatch('refresh-cart');
    }

    public function decrement(): void
    {
        /** @var Cart * */
        $cart = app(Cart::class);

        $cart->add($this->product, -1, $this->assemble);

        Notification::make()->title(__('Product decremented'))->danger()->send();

        $this->dispatch('refresh-cart');
    }

    public function remove(): void
    {
        $cart = app(Cart::class);

        $cart->remove($this->product, true);

        Notification::make()->title(__('Product removed from cart'))->danger()->send();

        $this->dispatch('refresh-cart');
    }

    #[On('variant-selection-changed')]
    public function variantChanged(int $variant_id): void
    {
        /**
         * @var ProductVariant
         */
        $variant = ProductVariant::find($variant_id);

        $this->product = $variant;
    }

    public function render(): View
    {
        /** @var Cart */
        $cart = app(Cart::class);

        $this->productQuantity = $cart->getTotalQuantityForProduct($this->product, true);

        return view('livewire.buttons.increment-decrement-cart');
    }
}
