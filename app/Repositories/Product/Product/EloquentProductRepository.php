<?php

declare(strict_types=1);

namespace App\Repositories\Product\Product;

use App\Models\Product;
use Illuminate\Database\Eloquent\Collection;

class EloquentProductRepository implements ProductRepositoryInterface
{
    /**
     * @return Collection<int, Product>
     */
    public function getAll(): Collection
    {
        return Product::where('published', true)->get();
    }

    /**
     * @return Collection<int, Product>
     */
    public function featured(): Collection
    {
        $featured_products = config('custom.featured-products');

        return Product::whereIn('id', $featured_products)->get();
    }
}
