<?php

declare(strict_types=1);

namespace App\View\Components;

use App\Models\Product;
use App\Models\ProductComplement;
use App\Models\ProductSparePart;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ProductContainer extends Component
{
    public function __construct(public Product|ProductComplement|ProductSparePart $product)
    {
    }

    public function render(): View|Closure|string
    {
        return view('components.product-container');
    }
}
