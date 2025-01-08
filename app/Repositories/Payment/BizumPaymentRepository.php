<?php

declare(strict_types=1);

namespace App\Repositories\Payment;

use App\Models\Order;
use App\Repositories\Payment\Traits\PaymentActions;
use Creagia\LaravelRedsys\RequestBuilder;
use Creagia\Redsys\Enums\Currency;
use Creagia\Redsys\Enums\PayMethod;
use Creagia\Redsys\Enums\TransactionType;
use Creagia\Redsys\Support\RequestParameters;
use Illuminate\Http\Response;
use Illuminate\Support\Str;

class BizumPaymentRepository implements PaymentRepositoryInterface
{
    use PaymentActions;

    public function payPurchase(Order $order): Response
    {
        $redsysRequestBuilder = RequestBuilder::newRequest(
            new RequestParameters(
                transactionType: TransactionType::Autorizacion,
                productDescription: 'Compra en Casa Quiroga',
                amountInCents: $order->getTotalAmount(),
                currency: Currency::EUR,
                payMethods: PayMethod::Bizum,
                order: Str::take($order->id, 12),
            )
        );

        return $redsysRequestBuilder->redirect();
    }

    public function isGatewayOkWithPayment(Order $order): bool
    {
        // TODO: get merchant params
        return true;
    }
}
