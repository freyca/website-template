<?php

declare(strict_types=1);

namespace App\Repositories\Database\Order\ProductComplement;

use App\Models\Order;
use App\Models\OrderProductComplement;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;

class EloquentOrderProductComplementRepository implements OrderProductComplementRepositoryInterface
{
    public function save(Order $order, array $productData): bool
    {
        $o = $order->orderProductComplements()->save(
            new OrderProductComplement(
                [
                    'product_complement_id' => Arr::get($productData, 'product_id'),
                    'unit_price' => Arr::get($productData, 'price'),
                    'quantity' => Arr::get($productData, 'quantity'),
                ]
            ),
        );

        return is_a($o, Model::class);
    }
}
