<?php

namespace App\Servies;

use App\Models\Order;
use App\Repositories\Payment\PaymentRepositoryInterface;

final readonly class Payment
{
    private readonly PaymentRepositoryInterface $repository;

    public function __construct(private Order $order)
    {
        $this->repository = $order->payment_method;
    }

    public function isPurchasePayed(Order $order): bool
    {
        return $this->repository->isPurchasePayed($order);
    }

    public function payPurchase(Order $order): bool
    {
        return $this->repository->payPurchase($order);
    }

    public function cancelPurchase(Order $order): void
    {
        return $this->repository->cancelPurchase($order);
    }
}
