<?php

declare(strict_types=1);

namespace App\Repositories\Product\ProductSparePart;

use App\Models\ProductSparePart;
use App\Repositories\Product\BaseProductRepositoryInterface;
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
}
