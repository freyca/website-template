<?php

declare(strict_types=1);

namespace App\Repositories\Database\Product\ProductComplement;

use App\Models\ProductComplement;
use App\Repositories\Database\Traits\CacheKeys;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Cache;

class EloquentProductComplementRepository implements ProductComplementRepositoryInterface
{
    use CacheKeys;

    /**
     * @return Collection<int, ProductComplement>
     */
    public function getAll(): Collection
    {
        $cacheKey = $this->generateCacheKey(__FUNCTION__);

        return Cache::remember($cacheKey, 3600, function () {
            return ProductComplement::where('published', true)->get();
        });
    }

    /**
     * @return Collection<int, ProductComplement>
     */
    public function featured(): Collection
    {
        $cacheKey = $this->generateCacheKey(__FUNCTION__);

        return Cache::remember($cacheKey, 3600, function () {
            $featured_products = config('custom.featured-product-complements');

            return ProductComplement::whereIn('id', $featured_products)->get();
        });
    }
}
