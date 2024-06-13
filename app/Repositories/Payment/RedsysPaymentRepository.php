<?php

declare(strict_types=1);

namespace App\Repositories\Payment;

use App\Models\Order;
use App\Traits\PaymentActions;

class RedsysPaymentRepository implements PaymentRepositoryInterface
{
    use PaymentActions;

    public function payPurchase(Order $order): bool
    {
        return false;

        //return $order->save([
        //    'payed' => true,
        //]);
    }
}
