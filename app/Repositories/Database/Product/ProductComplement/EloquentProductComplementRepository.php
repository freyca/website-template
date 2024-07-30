<?php

declare(strict_types=1);

namespace App\Repositories\Database\Product\ProductComplement;

use App\DTO\FilterDTO;
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

    public function filter(FilterDTO $filters): Collection
    {
        $query = ProductComplement::where('price', '<', $filters->maxPrice)
            ->where('price', '>', $filters->minPrice)
            ->where('published', true);

        if ($filters->features !== []) {
            $query = $query->whereHas('productFeatureValues', function ($query) use ($filters) {
                return $query->whereIn('product_complement_id', $filters->features);
            });
        }

        return $query->get();
    }
}
