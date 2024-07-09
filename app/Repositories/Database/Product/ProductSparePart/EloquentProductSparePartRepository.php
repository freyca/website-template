<?php

declare(strict_types=1);

namespace App\Repositories\Database\Product\ProductSparePart;

use App\Models\ProductSparePart;
use App\Repositories\Database\Traits\CacheKeys;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Cache;

class EloquentProductSparePartRepository implements ProductSparePartRepositoryInterface
{
    use CacheKeys;

    /**
     * @return Collection<int, ProductSparePart>
     */
    public function getAll(): Collection
    {
        $cacheKey = $this->generateCacheKey(__FUNCTION__);

        return Cache::remember($cacheKey, 3600, function () {
            return ProductSparePart::where('published', true)->get();
        });
    }

    /**
     * @return Collection<int, ProductSparePart>
     */
    public function featured(): Collection
    {
        $cacheKey = $this->generateCacheKey(__FUNCTION__);

        return Cache::remember($cacheKey, 3600, function () {
            $featured_products = config('custom.featured-product-spare-parts');

            return ProductSparePart::whereIn('id', $featured_products)->where('published', true)->get();
        });
    }
}
