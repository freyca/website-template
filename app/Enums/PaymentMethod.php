<?php

declare(strict_types=1);

namespace App\Enums;

use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasIcon;
use Filament\Support\Contracts\HasLabel;

enum PaymentMethod: string implements HasColor, HasIcon, HasLabel
{
    case Card = 'Card';
    case BankTransfer = 'Bank transfer';
    //case Bizum = 'Bizum';

    public function getLabel(): string
    {
        return match ($this) {
            self::BankTransfer => 'Bank transfer',
            self::Card => 'Card',
            //self::Bizum => 'Bizum',
        };
    }

    public function getColor(): string|array|null
    {
        return match ($this) {
            self::BankTransfer => 'warning',
            self::Card => 'success',
            //self::Bizum => 'info',
        };
    }

    public function getIcon(): ?string
    {
        return match ($this) {
            self::BankTransfer => 'heroicon-c-building-office-2',
            self::Card => 'heroicon-s-credit-card',
            //self::Bizum => 'heroicon-o-device-phone-mobile',
        };
    }
}
