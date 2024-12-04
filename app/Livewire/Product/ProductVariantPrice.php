<?php

namespace App\Livewire\Product;

use App\Models\ProductVariant;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\On;
use Livewire\Component;

class ProductVariantPrice extends Component
{
    public ProductVariant $variant;

    #[On('variant-selection-changed')]
    public function variantSelectionChanged(int $variant_id): void
    {
        /**
         * @var ProductVariant
         */
        $variant = ProductVariant::find($variant_id);

        $this->variant = $variant;
    }

    public function render(): View
    {
        return view('livewire.product.product-variant-price');
    }
}
