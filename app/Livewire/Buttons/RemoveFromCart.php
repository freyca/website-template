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

class RemoveFromCart extends Component
{
    public BaseProduct $product;

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
        return view('livewire.buttons.remove-from-cart');
    }
}
