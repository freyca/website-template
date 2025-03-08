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

class AddToCart extends Component
{
    use AssemblyStatusChanger;
    use ProductVariantChanger;

    public BaseProduct|ProductVariant $product;

    public string $icon;

    public function add(): void
    {
        /** @var Cart * */
        $cart = app(Cart::class);

        if ($cart->add($this->product, 1, $this->getAssemblyStatus())) {
            Notification::make()->title(__('Product added correctly'))->success()->send();
        } else {
            Notification::make()->title(__('Failed to add product'))->danger()->send();
        }

        $this->dispatch('refresh-cart');
    }

    public function render(): View
    {
        $this->icon = $this->product->stock > 0 ? 'heroicon-o-shopping-bag' : 'heroicon-m-x-mark';

        return view('livewire.buttons.add-to-cart');
    }
}
