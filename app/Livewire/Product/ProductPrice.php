<?php

declare(strict_types=1);

namespace App\Livewire\Product;

use App\Models\BaseProduct;
use App\Models\ProductVariant;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\On;
use Livewire\Component;

class ProductPrice extends Component
{
    public BaseProduct $product;

    #[On('variant-selection-changed')]
    public function variantSelectionChanged(int $variant_id): void
    {
        /**
         * @var ProductVariant
         */
        $variant = ProductVariant::find($variant_id);

        $this->product = $variant;
    }

    public function render(): View
    {
        return view('livewire.product.product-price');
    }
}
