<?php

namespace App\Repositories\Payment;

use App\Models\Order;
use App\Traits\PaymentActions;

class BankTransferPaymentRepository implements PaymentRepositoryInterface
{
    use PaymentActions;

    public function payPurchase(Order $order): bool
    {
        return false;
    }
}
