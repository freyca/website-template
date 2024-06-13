<?php

declare(strict_types=1);

namespace App\Traits;

use NumberFormatter;

trait CurrencyFormatter
{
    public function formatCurrency(float $value): string
    {
        $formatter = new NumberFormatter('es_ES', NumberFormatter::CURRENCY);

        /** @var string */
        return $formatter->formatCurrency($value, 'EUR');
    }
}
