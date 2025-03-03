<?php

declare(strict_types=1);

namespace App\Repositories\Database\Product\ProductComplement;

use App\DTO\FilterDTO;
use App\Models\ProductComplement;
use App\Repositories\Database\Traits\CacheKeys;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Cache;

class EloquentProductComplementRepository implements ProductComplementRepositoryInterface
{
    use CacheKeys;

    public function getAll(): LengthAwarePaginator
    {
        $cacheKey = $this->generateCacheKey(__FUNCTION__);

        // return Cache::remember($cacheKey, 3600, function () {
        return ProductComplement::paginate(15);
        // });
    }

    public function featured(): Collection
    {
        $cacheKey = $this->generateCacheKey(__FUNCTION__);

        /**
         * @var Collection<int, ProductComplement>
         */
        return Cache::remember($cacheKey, 3600, function () {
            $featured_products = config('custom.featured-product-complements');

            return ProductComplement::whereIn('id', $featured_products)->get();
        });
    }

    public function filter(FilterDTO $filters): Collection
    {
        $query = ProductComplement::where(function ($q) use ($filters) {
            $q->where('price', '>', $filters->minPrice)->where('price_with_discount', null)
                ->orWhere('price_with_discount', '>', $filters->minPrice);
        })->where(function ($q) use ($filters) {
            $q->where('price', '<', $filters->maxPrice)->where('price_with_discount', null)
                ->orWhere('price_with_discount', '<', $filters->maxPrice);
        });

        if ($filters->features !== []) {
            $query = $query->whereHas('productFeatureValues', function ($query) use ($filters) {
                return $query->where('product_complement_feature_value_id', $filters->features);
            });
        }

        return $query->get();
    }
}
