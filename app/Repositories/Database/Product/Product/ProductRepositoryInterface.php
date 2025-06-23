<?php

declare(strict_types=1);

namespace App\Repositories\Database\Product\Product;

use App\DTO\FilterDTO;
use App\Repositories\Database\Product\BaseProductRepositoryInterface;
use Illuminate\Pagination\LengthAwarePaginator;

interface ProductRepositoryInterface extends BaseProductRepositoryInterface
{
    public function getAll(): LengthAwarePaginator;

    public function featured(): LengthAwarePaginator;

    public function filter(FilterDTO $filters): LengthAwarePaginator;
}
