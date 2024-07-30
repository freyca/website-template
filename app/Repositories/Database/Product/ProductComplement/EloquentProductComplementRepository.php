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

    public function getAll(): Collection
    {
        $cacheKey = $this->generateCacheKey(__FUNCTION__);

        return Cache::remember($cacheKey, 3600, function () {
            return ProductComplement::where('published', true)->get();
        });
    }

    public function featured(): Collection
    {
        $cacheKey = $this->generateCacheKey(__FUNCTION__);

        return Cache::remember($cacheKey, 3600, function () {
            $featured_products = config('custom.featured-product-complements');

            return ProductComplement::whereIn('id', $featured_products)->where('published', true)->get();
        });
    }

    public function filter(array $filters): Collection
    {
        if (
            data_get($filters, 'filteredFeatures') !== []
        ) {
            return
                ProductComplement::whereHas('productFeatureValues', function ($query) use ($filters) {
                    return $query->whereIn('product_complement_id', data_get($filters, 'filteredFeatures'));
                })
                    ->where('price', '<', data_get($filters, 'maxPrice'))
                    ->where('price', '>', data_get($filters, 'minPrice'))
                    ->where('published', true)
                    ->get();
        } else {
            return
                ProductComplement::where('price', '<', data_get($filters, 'maxPrice'))
                    ->where('price', '>', data_get($filters, 'minPrice'))
                    ->where('published', true)
                    ->get();
        }
    }
}
