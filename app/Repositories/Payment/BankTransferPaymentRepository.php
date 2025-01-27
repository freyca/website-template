<?php

declare(strict_types=1);

namespace App\Repositories\Payment;

use App\Models\Order;
use App\Repositories\Payment\Traits\PaymentActions;

class BankTransferPaymentRepository implements PaymentRepositoryInterface
{
    use PaymentActions;

    public function payPurchase(Order $order)
    {
        return response(null, 301, [
            'Location' => route('payment.purchase-complete', ['order' => $order->id]),
        ]);
    }

    public function isGatewayOkWithPayment(Order $order): bool
    {
        return true;
    }
}
