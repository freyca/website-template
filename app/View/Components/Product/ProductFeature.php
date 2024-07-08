<?php

declare(strict_types=1);

namespace App\View\Components\Product;

use App\Models\ProductFeatureValue;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ProductFeature extends Component
{
    public function __construct(public ProductFeatureValue $feature)
    {
    }

    public function render(): View
    {
        return view('components.product.product-feature');
    }
}
