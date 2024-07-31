<?php

declare(strict_types=1);

namespace App\Repositories\Database\Product\Product;

use App\DTO\FilterDTO;
use App\Models\Product;
use App\Repositories\Database\Traits\CacheKeys;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Cache;

class EloquentProductRepository implements ProductRepositoryInterface
{
    use CacheKeys;

    public function getAll(): LengthAwarePaginator
    {
        $cacheKey = $this->generateCacheKey(__FUNCTION__);

        //return Cache::remember($cacheKey, 3600, function () {
        return Product::where('published', true)->paginate(15);
        //});
    }

    public function featured(): Collection
    {
        $cacheKey = $this->generateCacheKey(__FUNCTION__);

        return Cache::remember($cacheKey, 3600, function () {
            $featured_products = config('custom.featured-products');

            return Product::whereIn('id', $featured_products)->where('published', true)->get();
        });
    }

    public function filter(FilterDTO $filters): Collection
    {
        $query = Product::where('published', true)
            ->where(function ($q) use ($filters) {
                $q->where('price', '>', $filters->minPrice)->where('price_with_discount', null)
                    ->orWhere('price_with_discount', '>', $filters->minPrice);
            })->where(function ($q) use ($filters) {
                $q->where('price', '<', $filters->maxPrice)->where('price_with_discount', null)
                    ->orWhere('price_with_discount', '<', $filters->maxPrice);
            });

        if ($filters->category !== 0) {
            $query = $query->where('category_id', $filters->category);
        }

        if ($filters->features !== []) {
            $query = $query->whereHas('productFeatureValues', function ($query) use ($filters) {
                return $query->whereIn('product_id', $filters->features);
            });
        }

        return $query->get();
    }
}
