<?php

declare(strict_types=1);

namespace App\Repositories\Payment;

use App\Models\Order;
use Illuminate\Http\Request;

interface PaymentRepositoryInterface
{
    public function isPurchasePayed(Order $order): bool;

    public function payPurchase(Order $order);

    public function cancelPurchase(Order $order): void;

    public function isGatewayOkWithPayment(Order $order, Request $request): bool;
}
