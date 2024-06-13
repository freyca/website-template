<?php

declare(strict_types=1);

namespace App\Payment\Traits;

use App\Enums\OrderStatus;
use App\Models\Order;

trait PaymentActions
{
    public function isPurchasePayed(Order $order): bool
    {
        return $order->status !== OrderStatus::PENDING_PAYMENT;
    }

    public function cancelPurchase(Order $order): void
    {
        $order->delete();
    }
}
