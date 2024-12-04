<?php

declare(strict_types=1);

namespace App\Repositories\Payment;

use App\Models\Order;
use App\Repositories\Payment\Traits\PaymentActions;

class BankTransferPaymentRepository implements PaymentRepositoryInterface
{
    use PaymentActions;

    public function payPurchase(Order $order): string
    {
        return 'finished-purchase';
    }

    public function isGatewayOkWithPayment(Order $order): bool
    {
        return true;
    }
}
