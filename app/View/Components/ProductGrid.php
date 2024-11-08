<?php

declare(strict_types=1);

namespace App\View\Components;

use App\Models\BaseProduct;
use Illuminate\Contracts\View\View;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\View\Component;

class ProductGrid extends Component
{
    /**
     * @param  LengthAwarePaginator<BaseProduct>  $products
     */
    public function __construct(
        public LengthAwarePaginator $products
    ) {}

    public function render(): View
    {
        return view('components.product-grid');
    }
}
