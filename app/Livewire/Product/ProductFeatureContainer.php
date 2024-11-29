<?php

namespace App\Livewire\Product;

use Livewire\Component;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Attributes\On;
use App\Models\ProductVariant;

class ProductFeatureContainer extends Component
{
    public Collection $features;

    public Collection $featureValues;

    #[On('variant-selection-changed')]
    public function variantSelectionChanged($variant_id)
    {
        $variant = ProductVariant::find($variant_id);
        $product = $variant->product;

        // Get product values
        $features = $product->productFeatures();
        $featureValues = $product->productFeatureValues;

        // Merge with variant values
        $this->features = $features->merge($variant->productFeatures())->unique();
        $this->featureValues = $featureValues->merge($variant->productFeatureValues()->get())->unique();
    }

    public function render()
    {
        return view('livewire.product.product-feature-container');
    }
}
