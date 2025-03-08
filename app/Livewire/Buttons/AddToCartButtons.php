<?php

declare(strict_types=1);

namespace App\Livewire\Buttons;

use App\Livewire\Buttons\Traits\AssemblyStatusChanger;
use App\Livewire\Buttons\Traits\ProductVariantChanger;
use App\Models\BaseProduct;
use App\Models\ProductVariant;
use App\Services\Cart;
use Illuminate\View\View;
use Livewire\Attributes\On;
use Livewire\Component;

class AddToCartButtons extends Component
{
    use AssemblyStatusChanger;
    use ProductVariantChanger;

    public bool $inCart;

    public BaseProduct|ProductVariant $product;

    #[On('refresh-cart')]
    public function render(): View
    {
        $cart = app(Cart::class);
        $this->inCart = $cart->hasProduct($this->product, $this->getAssemblyStatus());

        return view('livewire.buttons.add-to-cart-buttons');
    }
}
