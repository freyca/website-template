<?php

namespace App\Http\Controllers;

use App\Enums\OrderStatus;
use App\Models\Order;
use App\Services\Cart;
use Creagia\Redsys\Enums\Environment;
use Creagia\Redsys\RedsysClient;
use Creagia\Redsys\RedsysResponse;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
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

        $redsysNotification = new RedsysResponse($redsysClient);
        $redsysNotification->setParametersFromResponse($_POST);

        try {
            $notificationData = $redsysNotification->checkResponse();
            $order->status = OrderStatus::Paid;
        } catch (\Exception $e) {
            $errorMessage = $e->getMessage();
            $order->status = OrderStatus::PaymentFailed;
        }

        $order->save();
    }
}
