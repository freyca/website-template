<?php

declare(strict_types=1);

namespace App\Repositories\Database\Product\Product;

use App\DTO\FilterDTO;
use App\Models\Product;
use App\Repositories\Database\Product\BaseProductRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

interface ProductRepositoryInterface extends BaseProductRepositoryInterface
{
    /**
     * @return Collection<int, Product>
     */
    public function getAll(): Collection;

    /**
     * @return Collection<int, Product>
     */
    public function featured(): Collection;

    /**
     * @return Collection<int, Product>
     */
    public function filter(FilterDTO $filters): Collection;
}
