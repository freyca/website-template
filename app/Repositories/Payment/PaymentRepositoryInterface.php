<?php

declare(strict_types=1);

namespace App\Repositories\Payment;

use App\Models\Order;

interface PaymentRepositoryInterface
{
    public function isPurchasePayed(Order $order): bool;

    public function payPurchase(Order $order): string;

    public function cancelPurchase(Order $order): void;

    public function isGatewayOkWithPayment(Order $order): bool;
}
