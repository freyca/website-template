<?php

declare(strict_types=1);

namespace App\Repositories\Database\Product\ProductSparePart;

use App\DTO\FilterDTO;
use App\Models\ProductSparePart;
use App\Repositories\Database\Product\BaseProductRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

interface ProductSparePartRepositoryInterface extends BaseProductRepositoryInterface
{
    /**
     * @return Collection<int, ProductSparePart>
     */
    public function getAll(): Collection;

    /**
     * @return Collection<int, ProductSparePart>
     */
    public function featured(): Collection;

    /**
     * @return Collection<int, ProductSparePart>
     */
    public function filter(FilterDTO $filters): Collection;
}
