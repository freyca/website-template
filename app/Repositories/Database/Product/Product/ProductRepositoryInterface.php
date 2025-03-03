<?php

declare(strict_types=1);

namespace App\Repositories\Database\Product\Product;

use App\DTO\FilterDTO;
use App\Models\Product;
use App\Repositories\Database\Product\BaseProductRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

interface ProductRepositoryInterface extends BaseProductRepositoryInterface
{
    /**
     * @return LengthAwarePaginator<Product>
     */
    public function getAll(): LengthAwarePaginator;

    /**
     * @return Collection<Product>
     */
    public function featured(): LengthAwarePaginator;

    /**
     * @return Collection<Product>
     */
    public function filter(FilterDTO $filters): LengthAwarePaginator;
}
