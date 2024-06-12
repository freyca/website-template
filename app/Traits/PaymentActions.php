<?php

declare(strict_types=1);

namespace App\Traits;

use App\Models\Order;

trait PaymentActions
{
    public function isPurchasePayed(Order $order): bool
    {
        return $order->payed;
    }

    public function cancelPurchase(Order $order): void
    {
        $order->delete();
    }
}
