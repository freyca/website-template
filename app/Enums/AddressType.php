<?php

declare(strict_types=1);

namespace App\Enums;

use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasIcon;
use Filament\Support\Contracts\HasLabel;

enum AddressType: string implements HasColor, HasIcon, HasLabel
{
    case Billing = 'billing';
    case Shipping = 'shipping';

    public function getLabel(): string
    {
        return match ($this) {
            self::Billing => __('Billing'),
            self::Shipping => __('Shipping'),
        };
    }

    public function getColor(): string|array|null
    {
        return match ($this) {
            self::Billing => 'success',
            self::Shipping => 'info',
        };
    }

    public function getIcon(): ?string
    {
        return match ($this) {
            self::Billing => 'heroicon-c-document-currency-euro',
            self::Shipping => 'heroicon-o-truck',
        };
    }
}
