<?php

declare(strict_types=1);

namespace App\Repositories\Categories;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Eloquent\Collection;

interface CategoryRepositoryInterface
{
    /**
     * @return Collection<int, Category>
     */
    public function getAll(): Collection;

    /**
     * @return Collection<int, Product>
     */
    public function getProducts(Category $category): Collection;

    /**
     * @return Collection<int, Category>
     */
    public function featured(): Collection;
}
