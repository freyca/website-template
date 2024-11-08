<?php

namespace App\View\Components\Product;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use App\Models\Product;
use Illuminate\Database\Eloquent\Collection;

class ProductDetails extends Component
{
    public function __construct(
        public Product $product,
        public Collection $variants,
    )
    {
    }

    public function render(): View|Closure|string
    {
        return view('components.product.product-details');
    }
}
