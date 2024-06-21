<?php

declare(strict_types=1);

namespace App\Filament\Admin\Resources\Users\OrderResource\Pages;

use App\Enums\OrderStatus;
use App\Filament\Admin\Resources\Users\OrderResource;
use Filament\Actions;
use Filament\Resources\Components\Tab;
use Filament\Resources\Pages\ListRecords;

class ListOrders extends ListRecords
{
    protected static string $resource = OrderResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

    public function getTabs(): array
    {
        return [
            null => Tab::make(__('All')),
            __('New') => Tab::make()->query(fn ($query) => $query->where('status', OrderStatus::New)), // @phpstan-ignore-line
            __('Processing') => Tab::make()->query(fn ($query) => $query->where('status', OrderStatus::Processing)), // @phpstan-ignore-line
            __('Shipped') => Tab::make()->query(fn ($query) => $query->where('status', OrderStatus::Shipped)), // @phpstan-ignore-line
            __('Delivered') => Tab::make()->query(fn ($query) => $query->where('status', OrderStatus::Delivered)), // @phpstan-ignore-line
            __('Cancelled') => Tab::make()->query(fn ($query) => $query->where('status', OrderStatus::Cancelled)), // @phpstan-ignore-line
        ];
    }
}
