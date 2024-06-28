<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Enums\OrderStatus;
use App\Enums\PaymentMethod;
use App\Http\Requests\MerchantParamsRequest;
use App\Http\Requests\PaymentRequest;
use App\Models\Order;
use App\Services\Cart;
use App\Services\Payment;
use Illuminate\Support\Facades\Auth;

class PaymentController extends Controller
{
    public function index(PaymentRequest $request): bool
    {
        /**
         * @var Cart
         */
        $cart = app(Cart::class);

        /**
         * @var \App\Models\User|null
         */
        $user = Auth::getUser();

        if ($user === null) {
            return false;
        }

        $order = $cart->buildOrder(
            PaymentMethod::from(
                strval($request->string('payment_method'))
            ),
            $user
        );

        $paymentService = new Payment($order);

        return $paymentService->payPurchase();
    }

    /**
     * Comprobar respuesta de Redsys
     */
    public function checkResponse(MerchantParamsRequest $request): bool
    {
        /**
         * @var \App\Models\Order
         */
        $order = Order::find($request->orderId);

        $paymentService = new Payment($order);

        if ($paymentService->isGatewayOkWithPayment()) {
            $order->status = OrderStatus::Processing;
            $order->save();

            return true;
        }

        return false;
    }
}
