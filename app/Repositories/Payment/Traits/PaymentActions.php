<?php

declare(strict_types=1);

namespace App\Repositories\Payment\Traits;

use App\Casts\MoneyCast;

trait PaymentActions
{
    protected function convertPriceToCents(float|MoneyCast $price): int
    {
        return intval(bcmul(strval($price), '100'));
    }
}
