<?php

namespace App\Livewire\Product;

use App\Models\ProductVariant;
use Livewire\Attributes\On;
use Livewire\Component;

class ProductVariantPrice extends Component
{
    public ProductVariant $variant;

    #[On('variant-selection-changed')]
    public function variantSelectionChanged($variant_id)
    {
        $this->variant = ProductVariant::find($variant_id);
    }

    public function render()
    {
        return view('livewire.product.product-variant-price');
    }
}
