<?php

namespace App\Repositories\Payment;

use App\Models\Order;

interface PaymentRepositoryInterface
{
    public function isPurchasePayed(Order $order): bool;

    public function payPurchase(Order $order): bool;

    public function cancelPurchase(Order $order): void;
}
