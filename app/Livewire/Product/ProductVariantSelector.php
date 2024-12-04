<?php

namespace App\Livewire\Product;

use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Component;

class ProductVariantSelector extends Component
{
    /**
     * @var Collection<int, \App\Models\ProductVariant>
     */
    public Collection $variants;

    public int $variant_id;

    public function variantChanged(): void
    {
        $this->dispatch('variant-selection-changed', variant_id: $this->variant_id);
    }

    public function render(): View
    {
        return view('livewire.product.product-variant-selector');
    }
}
