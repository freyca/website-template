<?php

declare(strict_types=1);

namespace App\Livewire\Product;

use App\Livewire\Buttons\Traits\ProductVariantChanger;
use App\Models\BaseProduct;
use App\Models\ProductVariant;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\On;
use Livewire\Component;

class ProductPrice extends Component
{
    use ProductVariantChanger;

    public BaseProduct $product;

    public function render(): View
    {
        return view('livewire.product.product-price');
    }
}
