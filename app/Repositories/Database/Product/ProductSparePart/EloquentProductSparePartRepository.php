<?php

declare(strict_types=1);

namespace App\Repositories\Database\Product\ProductSparePart;

use App\Models\ProductSparePart;
use Illuminate\Database\Eloquent\Collection;

class EloquentProductSparePartRepository implements ProductSparePartRepositoryInterface
{
    /**
     * @return Collection<int, ProductSparePart>
     */
    public function getAll(): Collection
    {
        return ProductSparePart::where('published', true)->get();
    }

    /**
     * @return Collection<int, ProductSparePart>
     */
    public function featured(): Collection
    {
        $featured_products = config('custom.featured-product-spare-parts');

        return ProductSparePart::whereIn('id', $featured_products)->get();
    }
}
