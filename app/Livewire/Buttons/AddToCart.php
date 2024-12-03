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

        Notification::make()->title(__('Product added correctly'))->success()->send();

        $this->dispatch('refresh-cart');
    }

    #[On('variant-selection-changed')]
    public function variantChanged($variant_id)
    {
        $this->product = ProductVariant::find($variant_id);
    }

    public function render(): View
    {
        return view('livewire.buttons.add-to-cart');
    }
}
