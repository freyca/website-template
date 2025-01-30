<?php

declare(strict_types=1);

namespace App\Repositories\Payment;

use App\Models\Order;
use Creagia\Redsys\Enums\PayMethod;

class BizumPaymentRepository extends RedsysPaymentRepository
{
    public function payPurchase(Order $order)
    {
        return parent::createRedsysRequest($order, PayMethod::Bizum);
    }
}
