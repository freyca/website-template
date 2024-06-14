<?php

declare(strict_types=1);

namespace App\Repositories\Shop;

use App\Models\BaseProduct;

interface ShopRepositoryInterface
{
    public function find(int $productId): BaseProduct;
}
