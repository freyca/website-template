<?php

declare(strict_types=1);

namespace App\Repositories\Database\Order\Product;

use App\Models\Order;
use App\Repositories\Database\Order\BaseOrderProductRepositoryInterface;

interface OrderProductRepositoryInterface extends BaseOrderProductRepositoryInterface
{
    public function save(Order $order, array $productData): bool;
}
