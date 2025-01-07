<?php

declare(strict_types=1);

namespace App\Repositories\Database\Order\Product;

use App\Models\Order;
use App\Models\OrderProduct;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;

class EloquentOrderProductRepository implements OrderProductRepositoryInterface
{
    public function save(Order $order, array $productData): bool
    {
        $o = $order->orderProducts()->save(
            new OrderProduct(
                [
                    'product_id' => Arr::get($productData, 'product_id'),
                    'product_variant_id' => Arr::get($productData, 'product_variant_id'),
                    'unit_price' => Arr::get($productData, 'price'),
                    'quantity' => Arr::get($productData, 'quantity'),
                ]
            ),
        );

        return is_a($o, Model::class);
    }
}
