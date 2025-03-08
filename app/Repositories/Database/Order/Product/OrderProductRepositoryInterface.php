<?php

declare(strict_types=1);

namespace App\Repositories\Database\Order\Product;

use App\Models\Order;
use App\Models\OrderProduct;

interface OrderProductRepositoryInterface
{
    public function save(Order $order, OrderProduct $order_product): bool;
}
