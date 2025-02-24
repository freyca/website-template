<?php

namespace App\Livewire\Buttons;

use App\Livewire\Buttons\Traits\AssemblyStatusChanger;
use App\Livewire\Buttons\Traits\ProductVariantChanger;
use App\Models\BaseProduct;
use App\Services\Cart;
use Livewire\Attributes\On;
use Livewire\Component;

class AddToCartButtons extends Component
{
    use AssemblyStatusChanger;
    use ProductVariantChanger;

    public bool $inCart;

    public BaseProduct $product;

    #[On('refresh-cart')]
    public function render()
    {
        $cart = app(Cart::class);
        $this->inCart = $cart->hasProduct($this->product, $this->getAssemblyStatus());

        return view('livewire.buttons.add-to-cart-buttons');
    }
}
