<?php

namespace App\Http\Controllers;

use App\Enums\OrderStatus;
use App\Models\Order;
use App\Services\Cart;
use App\Services\OrderBuilder;
use App\Services\Payment;
use Creagia\Redsys\Enums\Environment;
use Creagia\Redsys\RedsysClient;
use Creagia\Redsys\RedsysResponse;
use Creagia\Redsys\Support\PostRequestError;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function redirectToPayment(Order $order)
    {
        $paymentService = new Payment($order);

        return $paymentService->payPurchase();
    }

    public function banktransfer(Order $order): string
    {
        $cart = app(Cart::class);
        $cart->clear();

        dump($order);

        return 'Debes pagar en el siguiente IBAN';
    }

    public function redsysOk(Order $order, Request $request): void
    {
        $cart = app(Cart::class);
        $cart->clear();

        $Ds_MerchantParameters = $request->Ds_MerchantParameters;

        dump($order);
        dump(json_decode(base64_decode($Ds_MerchantParameters)));
    }

    public function redsysKo(Order $order): void
    {
        $cart = app(Cart::class);
        $cart->clear();

        dump($order);
    }

    public function redsysNotification(Order $order, Request $request): void
    {
        $redsysClient = new RedsysClient(
            merchantCode: config('redsys.tpv.merchantCode'),
            secretKey: config('redsys.tpv.key'),
            terminal: config('redsys.tpv.terminal'),
            environment: config('redsys.environment') === 'production' ? Environment::Production : Environment::Test,
        );

        /**
         *  @see: https://github.com/creagia/laravel-redsys/blob/main/src/Controllers/RedsysNotificationController.php#L32
         */
        $redsysResponse = new RedsysResponse($redsysClient);
        $inputs = $request->all();
        $redsysResponse->setParametersFromResponse($inputs);

        $order->payment_gateway_response = $redsysResponse instanceof PostRequestError
            ? $redsysResponse->responseParameters
            : $redsysResponse->merchantParametersArray;

        try {
            $notificationData = $redsysResponse->checkResponse();
            $order->status = OrderStatus::Paid;
        } catch (\Exception $e) {
            $errorMessage = $e->getMessage();
            $order->status = OrderStatus::PaymentFailed;
        }

        $order->save();
    }
}
