<?php

declare(strict_types=1);

namespace App\Repositories\Payment\Traits;

use App\Enums\OrderStatus;
use App\Models\Order;

trait PaymentActions
{
    public function isPurchasePayed(Order $order): bool
    {
        return $order->status !== OrderStatus::New;
    }

    public function cancelPurchase(Order $order): void
    {
        $order->delete();
    }
}
