<?php

declare(strict_types=1);

namespace App\Services;

use App\Enums\PaymentMethods;
use App\Models\Order;
use App\Repositories\Payment\BankTransferPaymentRepository;
use App\Repositories\Payment\PaymentRepositoryInterface;
use App\Repositories\Payment\RedsysPaymentRepository;

final readonly class Payment
{
    private readonly PaymentRepositoryInterface $repository;

    public function __construct(Order $order)
    {
        $this->repository = match ($order->payment_method) {
            PaymentMethods::Card => new RedsysPaymentRepository(),
            default => new BankTransferPaymentRepository(),
        };
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
        $this->repository->cancelPurchase($order);
    }
}
