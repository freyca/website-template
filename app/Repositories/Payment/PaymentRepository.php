<?php

namespace App\Repositories\Payment;

use App\Enums\OrderStatus;
use App\Models\Order;
use App\Repositories\Database\Order\Order\OrderRepositoryInterface;
use App\Repositories\Payment\Traits\PaymentActions;

abstract class PaymentRepository implements PaymentRepositoryInterface
{
    use PaymentActions;

    function __construct(protected OrderRepositoryInterface $orderRepository) {}

    public function redirectWithFail(Order $order, ?string $response = null)
    {
        $this->orderRepository->changeStatus($order, OrderStatus::PaymentFailed);

        if ($response !== null) {
            $this->orderRepository->paymentGatewayResponse($order, json_encode($response));
        }

        return redirect()->route('payment.purchase-failed', ['order' => $order->id]);
    }
}
