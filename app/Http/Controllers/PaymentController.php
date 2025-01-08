<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Services\Cart;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function banktransfer(Order $orderId): string
    {
        $cart = app(Cart::class);
        $cart->clear();

        dump($orderId);

        return 'Debes pagar en el siguiente IBAN';
    }

    public function redsysOk(Order $orderId, Request $request): void
    {
        $cart = app(Cart::class);
        $cart->clear();

        $Ds_MerchantParameters = $request->Ds_MerchantParameters;

        dump($orderId);
        dump(json_decode(base64_decode($Ds_MerchantParameters)));
    }

    public function redsysKo(Order $orderId): void
    {
        $cart = app(Cart::class);
        $cart->clear();

        dump($orderId);
    }
}
