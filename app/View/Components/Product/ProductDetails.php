<?php

declare(strict_types=1);

namespace App\View\Components\Product;

use App\Models\BaseProduct;
use App\Models\ProductVariant;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Collection;
use Illuminate\View\Component;

class ProductDetails extends Component
{
    /**
     * @param  ?Collection<int, ProductVariant>  $variants
     */
    public function __construct(
        public BaseProduct $product,
        public Collection $variants,
    ) {}

    public function render(): View|Closure|string
    {
        return view('components.product.product-details');
    }
}
