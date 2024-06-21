<?php

declare(strict_types=1);

namespace App\Repositories\Database\Shop;

use App\Models\BaseProduct;

interface ShopRepositoryInterface
{
    public function find(int $productId): BaseProduct;
}
