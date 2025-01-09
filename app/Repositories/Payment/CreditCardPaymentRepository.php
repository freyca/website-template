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
use Creagia\Redsys\RedsysClient;
use Creagia\Redsys\RedsysRequest;
use Creagia\Redsys\Enums\Environment;


class CreditCardPaymentRepository implements PaymentRepositoryInterface
{
    use PaymentActions;

    public function payPurchase(Order $order)
    {
        $redsysClient = new RedsysClient(
            merchantCode: intval(config('redsys.tpv.merchantCode')),
            secretKey: config('redsys.tpv.key'),
            terminal: intval(config('redsys.tpv.terminal')),
            environment: config('redsys.environment') === 'production' ? Environment::Production : Environment::Test,
        );

        $redsysRequest = RedsysRequest::create(
            $redsysClient,
            new RequestParameters(
                amountInCents: $this->convertPriceToCents($order->purchase_cost),
                order: Str::take($order->id, 12),
                currency: Currency::EUR,
                transactionType: TransactionType::Autorizacion,
                payMethods: PayMethod::Card,
                merchantUrl: route('payment.redsys-notification', ['orderId' => $order->id]),
                urlOk: route('payment.redsys-ok', ['orderId' => $order->id]),
                urlKo: route('payment.redsys-ko', ['orderId' => $order->id]),
            )
        );

        return $redsysRequest->getRedirectFormHtml();
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
