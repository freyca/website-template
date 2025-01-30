<?php

declare(strict_types=1);

namespace App\Repositories\Payment;

use App\Models\Order;
use Illuminate\Http\Request;

interface PaymentRepositoryInterface
{
    public function payPurchase(Order $order);

    public function isGatewayOkWithPayment(Order $order, Request $request): bool;

    public function redirectWithFail(Order $order, ?string $response = null);
}
