<?php

declare(strict_types=1);

namespace App\Enums;

enum PaymentMethods
{
    case bank_transfer;
    case card;
}
