<?php

declare(strict_types=1);

namespace App\View\Components;

use App\Models\BaseProduct;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\View\Component;

class ProductGrid extends Component
{
    /**
     * @param  Collection<int, BaseProduct>  $products
     */
    public function __construct(
        public Collection $products
    ) {
    }

    public function render(): View
    {
        return view('components.product-grid');
    }
}
