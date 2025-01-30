<?php

declare(strict_types=1);

namespace App\Repositories\Database\Order\ProductSparePart;

use App\Models\Order;
use App\Repositories\Database\Order\BaseOrderProductRepositoryInterface;

interface OrderProductSparePartRepositoryInterface extends BaseOrderProductRepositoryInterface
{
    public function save(Order $order, array $productData): bool;
}
