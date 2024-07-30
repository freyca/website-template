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

    public function getAll(): Collection
    {
        $cacheKey = $this->generateCacheKey(__FUNCTION__);

        return Cache::remember($cacheKey, 3600, function () {
            return Product::where('published', true)->get();
        });
    }

    public function featured(): Collection
    {
        $cacheKey = $this->generateCacheKey(__FUNCTION__);

        return Cache::remember($cacheKey, 3600, function () {
            $featured_products = config('custom.featured-products');

            return Product::whereIn('id', $featured_products)->where('published', true)->get();
        });
    }

    public function filter(array $filters): Collection
    {
        if (
            data_get($filters, 'filteredCategory') !== 0 &&
            data_get($filters, 'filteredFeatures') !== []
        ) {
            return
                Product::whereHas('productFeatureValues', function ($query) use ($filters) {
                    return $query->whereIn('product_id', data_get($filters, 'filteredFeatures'));
                })
                    ->where('category_id', data_get($filters, 'filteredCategory'))
                    ->where('price', '<', data_get($filters, 'maxPrice'))
                    ->where('price', '>', data_get($filters, 'minPrice'))
                    ->where('published', true)
                    ->get();
        } elseif (data_get($filters, 'filteredCategory') !== 0) {
            return
                Product::where('price', '<', data_get($filters, 'maxPrice'))
                    ->where('price', '>', data_get($filters, 'minPrice'))
                    ->where('category_id', data_get($filters, 'filteredCategory'))
                    ->where('published', true)
                    ->get();
        } elseif (data_get($filters, 'filteredFeatures') !== []) {
            return
                Product::whereHas('productFeatureValues', function ($query) use ($filters) {
                    return $query->whereIn('product_id', data_get($filters, 'filteredFeatures'));
                })
                    ->where('price', '<', data_get($filters, 'maxPrice'))
                    ->where('price', '>', data_get($filters, 'minPrice'))
                    ->where('published', true)
                    ->get();
        } else {
            return
                Product::where('price', '<', data_get($filters, 'maxPrice'))
                    ->where('price', '>', data_get($filters, 'minPrice'))
                    ->where('published', true)
                    ->get();
        }
    }
}
