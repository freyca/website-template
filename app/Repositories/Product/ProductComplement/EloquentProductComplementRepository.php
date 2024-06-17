<?php

declare(strict_types=1);

namespace App\Repositories\Product\ProductComplement;

use App\Models\ProductComplement;
use Illuminate\Database\Eloquent\Collection;

class EloquentProductComplementRepository implements ProductComplementRepositoryInterface
{
    /**
     * @return Collection<int, ProductComplement>
     */
    public function getAll(): Collection
    {
        return ProductComplement::where('published', true)->get();
    }

    /**
     * @return Collection<int, ProductComplement>
     */
    public function featured(): Collection
    {
        $featured_products = config('custom.featured-product-complements');

        return ProductComplement::whereIn('id', $featured_products)->get();
    }
}
