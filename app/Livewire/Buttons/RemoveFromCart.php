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

class RemoveFromCart extends Component
{
    use AssemblyStatusChanger;
    use ProductVariantChanger;

    public BaseProduct|ProductVariant $product;

    public function remove(): void
    {
        $cart = app(Cart::class);

        $cart->remove($this->product, $this->getAssemblyStatus());

        Notification::make()->title(__('Product removed from cart'))->danger()->send();

        $this->dispatch('refresh-cart');
    }

    public function render(): View
    {
        return view('livewire.buttons.remove-from-cart');
    }
}
