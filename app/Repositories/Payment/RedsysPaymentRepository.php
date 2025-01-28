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
use Illuminate\Http\Request;
use Illuminate\Support\Str;

abstract class RedsysPaymentRepository implements PaymentRepositoryInterface
{
    use PaymentActions;

    private function createClient(): RedsysClient
    {
        return new RedsysClient(
            merchantCode: intval(config('redsys.tpv.merchantCode')),
            secretKey: config('redsys.tpv.key'),
            terminal: intval(config('redsys.tpv.terminal')),
            environment: config('redsys.environment') === 'production' ? Environment::Production : Environment::Test,
        );
    }

    public function createRedsysRequest(Order $order, PayMethod $payMethod)
    {
        $redsysRequest = RedsysRequest::create(
            $this->createClient(),
            new RequestParameters(
                amountInCents: $this->convertPriceToCents($order->purchase_cost),
                order: Str::take($order->id, 12),
                currency: Currency::EUR,
                transactionType: TransactionType::Autorizacion,
                payMethods: $payMethod,
                merchantUrl: route('payment.gateway-notification', ['order' => $order->id]),
                urlOk: route('payment.purchase-complete', ['order' => $order->id]),
                urlKo: route('payment.purchase-failed', ['order' => $order->id]),
            )
        );

        return $redsysRequest->getRedirectFormHtml();
    }

    public function isGatewayOkWithPayment(Order $order, Request $request): bool
    {
        /**
         *  @see: https://github.com/creagia/laravel-redsys/blob/main/src/Controllers/RedsysNotificationController.php#L32
         */
        $redsysResponse = new RedsysResponse($this->createClient());
        $inputs = $request->all();
        $redsysResponse->setParametersFromResponse($inputs);

        $order->payment_gateway_response = $redsysResponse instanceof PostRequestError
            ? $redsysResponse->responseParameters
            : $redsysResponse->merchantParametersArray;

        try {
            $notificationData = $redsysResponse->checkResponse();
            $order->status = OrderStatus::Paid;

            $order->save();

            return true;
        } catch (Exception $e) {
            $errorMessage = $e->getMessage();
            $order->status = OrderStatus::PaymentFailed;

            $order->save();
            return false;
        }
    }
}
