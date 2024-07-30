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

    public function getAll(): Collection
    {
        $cacheKey = $this->generateCacheKey(__FUNCTION__);

        return Cache::remember($cacheKey, 3600, function () {
            return ProductSparePart::where('published', true)->get();
        });
    }

    public function featured(): Collection
    {
        $cacheKey = $this->generateCacheKey(__FUNCTION__);

        return Cache::remember($cacheKey, 3600, function () {
            $featured_products = config('custom.featured-product-spare-parts');

            return ProductSparePart::whereIn('id', $featured_products)->where('published', true)->get();
        });
    }

    public function filter(array $filters): Collection
    {
        if (data_get($filters, 'filteredFeatures') !== []) {
            return
                ProductSparePart::whereHas('productFeatureValues', function ($query) use ($filters) {
                    return $query->whereIn('product_spare_part_id', data_get($filters, 'filteredFeatures'));
                })
                    ->where('price', '<', data_get($filters, 'maxPrice'))
                    ->where('price', '>', data_get($filters, 'minPrice'))
                    ->where('published', true)
                    ->get();
        } else {
            return
                ProductSparePart::where('price', '<', data_get($filters, 'maxPrice'))
                    ->where('price', '>', data_get($filters, 'minPrice'))
                    ->where('published', true)
                    ->get();
        }
    }
}
