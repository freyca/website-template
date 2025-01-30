<?php

declare(strict_types=1);

namespace App\Repositories\Database\Order;

use App\Models\Order;

interface BaseOrderProductRepositoryInterface
{
    public function save(Order $order, array $productData): bool;
}
