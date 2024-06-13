<?php

namespace App\Filament\Resources\ProductComplementResource\Pages;

use App\Filament\Resources\ProductComplementResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListProductComplements extends ListRecords
{
    protected static string $resource = ProductComplementResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
