<?php

declare(strict_types=1);

namespace App\Repositories\Database\Order\Product;

use App\Models\Order;
use App\Models\OrderProduct;
use Illuminate\Database\Eloquent\Model;

class EloquentOrderProductRepository implements OrderProductRepositoryInterface
{
    public function save(Order $order, OrderProduct $order_product): bool
    {
        $o = $order->orderProducts()->save($order_product);

        return ($o === false) ? $o : is_a($o, Model::class);
    }
}
