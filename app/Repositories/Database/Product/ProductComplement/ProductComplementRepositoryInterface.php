<?php

declare(strict_types=1);

namespace App\Repositories\Database\Product\ProductComplement;

use App\DTO\FilterDTO;
use App\Models\ProductComplement;
use App\Repositories\Database\Product\BaseProductRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

interface ProductComplementRepositoryInterface extends BaseProductRepositoryInterface
{
    /**
     * @return LengthAwarePaginator<ProductComplement>
     */
    public function getAll(): LengthAwarePaginator;

    /**
     * @return Collection<int, ProductComplement>
     */
    public function featured(): Collection;

    /**
     * @return Collection<int, ProductComplement>
     */
    public function filter(FilterDTO $filters): Collection;
}
