<?php

namespace App\Livewire\Product;

use Illuminate\Database\Eloquent\Collection;
use Livewire\Component;

class ProductVariantSelector extends Component
{
    public Collection $variants;

    public int $variant_id;

    public function variantChanged()
    {
        $this->dispatch('variant-selection-changed', variant_id: $this->variant_id);
    }

    public function render()
    {
        return view('livewire.product.product-variant-selector');
    }
}
