<?php

declare(strict_types=1);

namespace App\Repositories\Payment;

use App\Models\Order;
use App\Repositories\Payment\Traits\PaymentActions;
use Srmklive\PayPal\Services\PayPal as PayPalClient;

class PayPalPaymentRepository implements PaymentRepositoryInterface
{
    use PaymentActions;

    public function payPurchase(Order $order)
    {
        $provider = new PayPalClient;

        $provider->setApiCredentials($this->paypalConfig());

        $provider->getAccessToken();

        $provider->setCurrency('EUR');

        $response = $provider->createOrder([
            "intent" => "CAPTURE",
            "application_context" => [
                "return_url" => route('successTransaction'),
                "cancel_url" => route('cancelTransaction'),
            ],
            "purchase_units" => [
                0 => [
                    "amount" => [
                        "currency_code" => "EUR",
                        "value" => $order->purchase_cost,
                    ]
                ]
            ]
        ]);

        try {
            if (isset($response['id']) && $response['id'] != null) {
                foreach ($response['links'] as $link) {
                    if ($link['rel'] == 'approve') {
                        return redirect()->away($link['href']);
                    }
                }

                Session::flash('error', 'Something went wrong.');
                return redirect()->route('homepage');
            } else {
                Session::flash('error', $response['message'] ?? 'Something went wrong.');
                return redirect()->route('homepage');
            }
        } catch (\Throwable $throwable) {
            Session::flash('error', $throwable->getMessage() ?? 'Something went wrong.');
            return redirect()->route('homepage');
        }
    }

    public function isGatewayOkWithPayment(Order $order): bool
    {
        return true;
    }

    private function paypalConfig()
    {
        return config('paypal');
    }
}
