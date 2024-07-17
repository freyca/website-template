<?php

declare(strict_types=1);

namespace App\View\Components\Product;

use App\Models\ProductFeature;
use App\Models\ProductFeatureValue;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\View\Component;

class ProductFeatureContainer extends Component
{
    /**
     * @param  Collection<int, ProductFeature>  $features
     * @param  Collection<int, ProductFeatureValue>  $featureValues
     */
    public function __construct(
        public Collection $features,
        public Collection $featureValues
    ) {
    }

    public function render(): View|Closure|string
    {
        return view('components.product.product-feature-container');
    }
}
