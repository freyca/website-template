<?php

declare(strict_types=1);

namespace App\Enums;

use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasIcon;
use Filament\Support\Contracts\HasLabel;

enum PaymentMethods: string implements HasColor, HasIcon, HasLabel
{
    case BankTransfer = 'Bank transfer';
    case Card = 'Card';

    public function getLabel(): string
    {
        return match ($this) {
            self::BankTransfer => 'Bank transfer',
            self::Card => 'Card',
        };
    }

    public function getColor(): string|array|null
    {
        return match ($this) {
            self::BankTransfer => 'info',
            self::Card => 'warning',
        };
    }

    public function getIcon(): ?string
    {
        return match ($this) {
            self::BankTransfer => 'heroicon-m-sparkles',
            self::Card => 'heroicon-m-arrow-path',
        };
    }
}
