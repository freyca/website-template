<?php

declare(strict_types=1);

namespace App\Repositories\Database\Order\ProductSparePart;

use App\Models\Order;
use App\Models\OrderProductSparePart;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;

class EloquentOrderProductSparePartRepository implements OrderProductSparePartRepositoryInterface
{
    public function save(Order $order, array $productData): bool
    {
        $o = $order->orderProducts()->save(
            new OrderProductSparePart(
                [
                    'product_spare_part_id' => Arr::get($productData, 'product_id'),
                    'unit_price' => Arr::get($productData, 'price'),
                    'quantity' => Arr::get($productData, 'quantity'),
                ]
            ),
        );

        return is_a($o, Model::class);
    }
}
