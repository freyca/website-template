<?php

namespace App\Repositories\Shop;

use App\Models\BaseProduct;

interface ShopRepositoryInterface
{
    public function find(int $productId): BaseProduct;
}
