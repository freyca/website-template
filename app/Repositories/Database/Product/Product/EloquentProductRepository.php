<?php

declare(strict_types=1);

namespace App\Repositories\Database\Product\Product;

use App\Models\Product;
use App\Repositories\Database\Traits\CacheKeys;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Cache;

class EloquentProductRepository implements ProductRepositoryInterface
{
    use CacheKeys;

    /**
     * @return Collection<int, Product>
     */
    public function getAll(): Collection
    {
        $cacheKey = $this->generateCacheKey(__FUNCTION__);

        return Cache::remember($cacheKey, 3600, function () {
            return Product::where('published', true)->get();
        });
    }

    /**
     * @return Collection<int, Product>
     */
    public function featured(): Collection
    {
        $cacheKey = $this->generateCacheKey(__FUNCTION__);

        return Cache::remember($cacheKey, 3600, function () {
            $featured_products = config('custom.featured-products');

            return Product::whereIn('id', $featured_products)->where('published', true)->get();
        });
    }
}
