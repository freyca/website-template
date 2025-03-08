<?php

declare(strict_types=1);

namespace App\Livewire\Buttons;

use App\Livewire\Buttons\Traits\AssemblyStatusChanger;
use App\Livewire\Buttons\Traits\ProductVariantChanger;
use App\Models\BaseProduct;
use App\Models\ProductVariant;
use App\Services\Cart;
use Filament\Notifications\Notification;
use Illuminate\View\View;
use Livewire\Component;

class IncrementDecrementCart extends Component
{
    use AssemblyStatusChanger;
    use ProductVariantChanger;

    public BaseProduct|ProductVariant $product;

    public int $productQuantity = 0;

    public function increment(): void
    {
        /** @var Cart * */
        $cart = app(Cart::class);

        if ($cart->add($this->product, 1, $this->getAssemblyStatus())) {
            Notification::make()->title(__('Product incremented'))->success()->send();
        } else {
            Notification::make()->title(__('Not enough stock'))->danger()->send();
        }

        $this->dispatch('refresh-cart');
    }

    public function decrement(): void
    {
        /** @var Cart * */
        $cart = app(Cart::class);

        $cart->add($this->product, -1, $this->getAssemblyStatus());

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

    public function render(): View
    {
        /** @var Cart */
        $cart = app(Cart::class);

        $this->productQuantity = $cart->getTotalQuantityForProduct($this->product, $this->getAssemblyStatus());

        return view('livewire.buttons.increment-decrement-cart');
    }
}
