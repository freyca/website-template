<?php

namespace App\Http\Controllers;

use App\Enums\OrderStatus;
use App\Models\Order;
use App\Services\Payment;
use App\Services\Cart;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PaymentController extends Controller
{
    public function redirectToPayment(Order $order)
    {
        $paymentService = new Payment($order);

        return $paymentService->payPurchase();
    }

    public function orderFinishedOk(Order $order, Request $request): View
    {
        $cart = app(Cart::class);
        $cart->clear();

        $paymentService = new Payment($order);
        $paymentService->isGatewayOkWithPayment($request);

        return view(
            'pages.purchase-complete',
            [
                'order' => $order,
            ]
        );
    }

    public function orderFinishedKo(Order $order, Request $request): View
    {
        $cart = app(Cart::class);
        $cart->clear();

        $paymentService = new Payment($order);
        $paymentService->isGatewayOkWithPayment($request);

        $order->status = OrderStatus::PaymentFailed;
        $order->save();

        return view(
            'pages.purchase-complete',
            [
                'order' => $order,
            ]
        );
    }

    public function paymentGatewayNotification(Order $order, Request $request): void
    {
        $paymentService = new Payment($order);
        $paymentService->isGatewayOkWithPayment($request);
    }
}
