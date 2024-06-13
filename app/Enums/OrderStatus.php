<?php

namespace App\Enums;

use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasIcon;
use Filament\Support\Contracts\HasLabel;

enum OrderStatus: string implements HasColor, HasIcon, HasLabel
{
    case PENDING_PAYMENT = 'pending_payment';
    case PAYED = 'payed';
    case PENDING_DELIVERY = 'pending_delivery';
    case DELIVERING = 'delivering';
    case COMPLETED = 'completed';
    case CANCELLED = 'canceled';

    public function getLabel(): ?string
    {
        return match ($this) {
            self::PENDING_PAYMENT => 'Pending payment',
            self::PAYED => 'Payed',
            self::PENDING_DELIVERY => 'Pending delivery',
            self::DELIVERING => 'Delivering',
            self::COMPLETED => 'Completed',
            self::CANCELLED => 'Cancelled',
        };
    }

    public function getColor(): string|array|null
    {
        return match ($this) {
            self::PENDING_PAYMENT => 'warning',
            self::PAYED => 'info',
            self::PENDING_DELIVERY => '',
            self::DELIVERING => '',
            self::COMPLETED => 'success',
            self::CANCELLED => 'danger',
        };
    }

    public function getIcon(): ?string
    {
        return match ($this) {
            self::PENDING_PAYMENT => 'heroicon-m-currency-euro',
            self::PAYED => 'heroicon-m-building-storefront',
            self::PENDING_DELIVERY => 'heroicon-m-cube',
            self::DELIVERING => 'heroicon-m-archive-box',
            self::COMPLETED => 'heroicon-m-check-badge',
            self::CANCELLED => 'heroicon-m-no-symbol',
        };
    }
}
