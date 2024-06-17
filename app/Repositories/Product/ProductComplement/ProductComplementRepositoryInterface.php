<?php

declare(strict_types=1);

namespace App\Repositories\Product\ProductComplement;

use App\Models\ProductComplement;
use App\Repositories\Product\BaseProductRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

interface ProductComplementRepositoryInterface extends BaseProductRepositoryInterface
{
    /**
     * @return Collection<int, ProductComplement>
     */
    public function getAll(): Collection;

    /**
     * @return Collection<int, ProductComplement>
     */
    public function featured(): Collection;
}
