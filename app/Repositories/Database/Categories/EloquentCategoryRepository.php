<?php

declare(strict_types=1);

namespace App\Repositories\Database\Categories;

use App\Models\Category;
use App\Repositories\Database\Traits\CacheKeys;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Cache;

class EloquentCategoryRepository implements CategoryRepositoryInterface
{
    use CacheKeys;

    public function getAll(): Collection
    {
        $cacheKey = $this->generateCacheKey(__FUNCTION__);

        return Cache::remember($cacheKey, 3600, function () {
            return Category::all();
        });
    }

    public function getProducts(Category $category): Collection
    {
        $cacheKey = $this->generateCacheKey(__FUNCTION__);

        return Cache::remember($cacheKey, 3600, function () use ($category) {
            return $category->products()->where('published', true)->get();
        });
    }

    public function featured(): Collection
    {
        $cacheKey = $this->generateCacheKey(__FUNCTION__);

        return Cache::remember($cacheKey, 3600, function () {
            $featured_categories = config('custom.featured-categories');

            return Category::whereIn('id', $featured_categories)->get();
        });
    }
}
