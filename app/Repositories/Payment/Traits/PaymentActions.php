<?php

declare(strict_types=1);

namespace App\Repositories\Payment\Traits;

use App\Casts\MoneyCast;
use App\Enums\OrderStatus;
use App\Models\Order;

trait PaymentActions
{
    public function isPurchasePayed(Order $order): bool
    {
        return $order->status !== OrderStatus::Paid;
    }

    public function cancelPurchase(Order $order): void
    {
        $order->status = OrderStatus::Cancelled;
        $order->save();
    }

    protected function convertPriceToCents(float $price): int
    {
        return intval(bcmul(strval($price), "100"));
    }
}
