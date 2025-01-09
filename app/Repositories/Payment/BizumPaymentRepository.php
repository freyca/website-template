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

class BizumPaymentRepository implements PaymentRepositoryInterface
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
                payMethods: PayMethod::Bizum,
                merchantUrl: route('payment.redsys-notification', ['order' => $order->id]),
                urlOk: route('payment.redsys-ok', ['order' => $order->id]),
                urlKo: route('payment.redsys-ko', ['order' => $order->id]),
            )
        );

        return $redsysRequest->getRedirectFormHtml();
    }

    public function isGatewayOkWithPayment(Order $order): bool
    {
        // TODO: get merchant params
        return true;
    }
}
