<?php

declare(strict_types=1);

namespace App\Repositories\Payment;

use App\Enums\OrderStatus;
use App\Models\Order;
use App\Repositories\Payment\Traits\PaymentActions;
use Srmklive\PayPal\Services\PayPal as PayPalClient;
use Illuminate\Http\Request;

class PayPalPaymentRepository implements PaymentRepositoryInterface
{
    use PaymentActions;

    public function payPurchase(Order $order)
    {
        try {

            $provider = new PayPalClient;
            $provider->setApiCredentials($this->paypalConfig());
            $provider->getAccessToken();
            $provider->setCurrency('EUR');

            $response = $provider->createOrder([
                "intent" => "CAPTURE",
                "application_context" => [
                    "return_url" => route('payment.purchase-complete', ['order' => $order->id]),
                    "cancel_url" => route('payment.purchase-failed', ['order' => $order->id]),
                ],
                "purchase_units" => [
                    0 => [
                        "invoice_id" => $order->id,
                        "amount" => [
                            "currency_code" => "EUR",
                            "value" => $order->purchase_cost,
                        ]
                    ]
                ]
            ]);

            // If we get the link, we redirect to paypal
            if (isset($response['id']) && $response['id'] != null) {
                foreach ($response['links'] as $link) {
                    if ($link['rel'] == 'approve') {
                        return redirect()->away($link['href']);
                    }
                }
            }

            // Reached here, something has failed, mark order as failed and redirect user
            $this->redirectWithFail($order);
        } catch (\Throwable $throwable) {
            $this->redirectWithFail($order);
        }
    }

    public function isGatewayOkWithPayment(Order $order, Request $request): bool
    {
        return true;
    }

    private function paypalConfig()
    {
        return config('paypal');
    }

    private function redirectWithFail(Order $order)
    {
        $order->status = OrderStatus::PaymentFailed;
        $order->save();

        $cart = app(\App\Services\Cart::class);
        $cart->clear();

        return redirect()->route('payment.purchase-failed', ['order' => $order->id]);
    }
}
