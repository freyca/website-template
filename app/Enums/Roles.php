<?php

declare(strict_types=1);

namespace App\Enums;

enum Roles
{
    case customer;
    case reseller;
    case admin;
}
