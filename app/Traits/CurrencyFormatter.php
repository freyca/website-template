<?php

declare(strict_types=1);

namespace App\Traits;

use Illuminate\Support\Number;

trait CurrencyFormatter
{
    public function formatCurrency(float $value): string
    {
        return Number::currency(
            $value,
            in: 'EUR',
            locale: config('app.locale')
        );
    }
}
