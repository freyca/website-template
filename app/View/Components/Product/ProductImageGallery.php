<?php

declare(strict_types=1);

namespace App\View\Components\Product;

use App\Models\Product;
use App\Models\ProductComplement;
use App\Models\ProductSparePart;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ProductImageGallery extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public Product|ProductComplement|ProductSparePart $product
    ) {
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.product.product-image-gallery');
    }
}
