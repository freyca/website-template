<?php

declare(strict_types=1);

namespace App\Enums;

enum PaymentMethods: string
{
    case Bank_transfer = 'Bank transfer';
    case Card = 'Card';
}
