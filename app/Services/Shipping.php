<?php

declare(strict_types=1);

namespace App\Services;

use App\Repositories\Shipping\ShippingRepositoryInterface;

final readonly class Shipping
{
    public function __construct(private readonly ShippingRepositoryInterface $repository)
    {
    }
}
