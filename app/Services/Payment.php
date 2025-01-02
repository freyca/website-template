<?php

declare(strict_types=1);

namespace App\Services;

use App\Enums\PaymentMethod;
use App\Models\Order;
use App\Repositories\Payment\BankTransferPaymentRepository;
use App\Repositories\Payment\PaymentRepositoryInterface;
use App\Repositories\Payment\RedsysPaymentRepository;

final class Payment
{
    private readonly PaymentRepositoryInterface $repository;

    public function __construct(private Order $order)
    {
        $this->repository = match ($order->payment_method) {
            PaymentMethod::Card => new RedsysPaymentRepository,
            default => new BankTransferPaymentRepository,
        };
    }

    public function isPurchasePayed(): bool
    {
        return $this->repository->isPurchasePayed($this->order);
    }

    public function payPurchase(): string
    {
        return $this->repository->payPurchase($this->order);
    }

    public function cancelPurchase(): void
    {
        $this->repository->cancelPurchase($this->order);
    }

    public function isGatewayOkWithPayment(): bool
    {
        return $this->repository->isGatewayOkWithPayment($this->order);
    }
}
