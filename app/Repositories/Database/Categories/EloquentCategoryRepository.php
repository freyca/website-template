<?php

declare(strict_types=1);

namespace App\Repositories\Database\Categories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Collection;

class EloquentCategoryRepository implements CategoryRepositoryInterface
{
    public function getAll(): Collection
    {
        return Category::all();
    }

    public function getProducts(Category $category): Collection
    {
        return $category->products()->where('published', true)->get();
    }

    public function featured(): Collection
    {
        $featured_categories = config('custom.featured-categories');

        return Category::whereIn('id', $featured_categories)->get();
    }
}
