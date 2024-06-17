<?php

declare(strict_types=1);

namespace App\Repositories\Product\Product;

use App\Models\Product;
use App\Repositories\Product\BaseProductRepositoryInterface;
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
}
