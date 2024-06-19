<?php

declare(strict_types=1);

namespace App\Filament\Resources\Users\OrderResource\Pages;

use App\Filament\Resources\Users\OrderResource;
use Filament\Actions;
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
}