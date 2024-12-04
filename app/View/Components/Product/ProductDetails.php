<?php

namespace App\View\Components\Product;

use App\Models\Product;
use App\Models\ProductVariant;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\View\Component;

class ProductDetails extends Component
{
    /**
     * @param  Collection<int, ProductVariant>  $variants
     */
    public function __construct(
        public Product $product,
        public Collection $variants,
    ) {}

    public function render(): View|Closure|string
    {
        return view('components.product.product-details');
    }
}
