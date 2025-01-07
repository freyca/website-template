<?php

declare(strict_types=1);

namespace App\Repositories\Database\Order\ProductComplement;

use App\Models\Order;
use App\Repositories\Database\Order\BaseOrderProductRepositoryInterface;

interface OrderProductComplementRepositoryInterface extends BaseOrderProductRepositoryInterface
{
    public function save(Order $order, array $productData): bool;
}
