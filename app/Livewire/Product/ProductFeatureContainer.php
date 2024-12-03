<?php

namespace App\Livewire\Product;

use App\Models\ProductVariant;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Attributes\On;
use Livewire\Component;

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
