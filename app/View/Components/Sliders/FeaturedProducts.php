<?php

declare(strict_types=1);

namespace App\View\Components\Sliders;

use App\Models\Product;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\View\Component;

class FeaturedProducts extends Component
{
    /**
     * @param  Collection<int, Product>  $featuredProducts
     */
    public function __construct(
        public Collection $featuredProducts
    ) {}

    public function render(): View
    {
        return view('components.sliders.featured-products');
    }
}
