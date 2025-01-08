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
use Exception;
use Illuminate\Http\Response;
use Illuminate\Support\Str;

class RedsysPaymentRepository implements PaymentRepositoryInterface
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
                payMethods: PayMethod::Card,
                order: Str::take($order->id, 12),
            )
        );

        return $redsysRequestBuilder->redirect();
    }

    public function isGatewayOkWithPayment(Order $order): bool
    {
        return true;

        // TODO: get merchant params
        //$merchantParams = [];
        //
        //try {
        //    $key = $this->key;
        //    $parameters = Redsys::getMerchantParameters($merchantParams);
        //    $DsResponse = $parameters['Ds_Response'];
        //    $DsResponse += 0;
        //
        //    if (Redsys::check($key, $merchantParams) && $DsResponse <= 99) {
        //        return true;
        //    } else {
        //        return false;
        //    }
        //} catch (Exception $e) {
        //    throw $e;
        //}
    }
}
