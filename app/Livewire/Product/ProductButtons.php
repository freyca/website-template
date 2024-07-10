<?php

declare(strict_types=1);

namespace App\Livewire\Product;

use App\Models\BaseProduct;
use Illuminate\View\View;
use Livewire\Attributes\On;
use Livewire\Component;

class ProductButtons extends Component
{
    public BaseProduct $product;

    #[On('refresh-cart')]
    public function render(): View
    {
        return view('livewire.product.product-buttons');
    }
}
