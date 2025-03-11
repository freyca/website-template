<?php

declare(strict_types=1);

namespace App\Repositories\Database\Order\Product;

use App\Models\Order;
use Illuminate\Support\Collection;

class EloquentOrderProductRepository implements OrderProductRepositoryInterface
{
    public function save(Order $order, Collection $order_products): void
    {
        $order->orderProducts()->saveMany($order_products);
    }
}
