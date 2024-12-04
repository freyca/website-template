<?php

namespace App\Livewire\Product;

use App\Models\ProductVariant;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Attributes\On;
use Livewire\Component;

class ProductFeatureContainer extends Component
{
    /**
     * @var Collection<int, \App\Models\ProductFeature>
     */
    public Collection $features;

    /**
     * @var Collection<int, \App\Models\ProductFeatureValue>
     */
    public Collection $featureValues;

    #[On('variant-selection-changed')]
    public function variantSelectionChanged(int $variant_id): void
    {
        /**
         * @var ProductVariant
         */
        $variant = ProductVariant::find($variant_id);

        /**
         * @var \App\Models\Product
         */
        $product = $variant->product;

        // Get product values
        $features = $product->productFeatures();

        /**
         * @var \Illuminate\Database\Eloquent\Collection<int, \App\Models\ProductFeatureValue>
         */
        $featureValues = $product->productFeatureValues;

        // Merge with variant values
        $this->features = $features->merge($variant->productFeatures())->unique();
        $this->featureValues = $featureValues->merge($variant->productFeatureValues()->get())->unique();
    }

    public function render(): View
    {
        return view('livewire.product.product-feature-container');
    }
}
