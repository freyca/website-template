<?php

namespace App\Servies;

use App\Repositories\Shipping\ShippingRepositoryInterface;

final readonly class Shipping
{
    public function __construct(private readonly ShippingRepositoryInterface $repository)
    {
    }
}
