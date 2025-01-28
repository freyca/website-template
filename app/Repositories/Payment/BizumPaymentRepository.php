<?php

declare(strict_types=1);

namespace App\Repositories\Payment;

use App\Enums\OrderStatus;
use App\Models\Order;
use App\Repositories\Payment\Traits\PaymentActions;
use Creagia\Redsys\Enums\Currency;
use Creagia\Redsys\Enums\Environment;
use Creagia\Redsys\Enums\PayMethod;
use Creagia\Redsys\Enums\TransactionType;
use Creagia\Redsys\RedsysClient;
use Creagia\Redsys\RedsysRequest;
use Creagia\Redsys\RedsysResponse;
use Creagia\Redsys\Support\PostRequestError;
use Creagia\Redsys\Support\RequestParameters;
use Exception;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class BizumPaymentRepository extends RedsysPaymentRepository
{
    public function payPurchase(Order $order)
    {
        return parent::createRedsysRequest($order, PayMethod::Bizum);
    }
}
