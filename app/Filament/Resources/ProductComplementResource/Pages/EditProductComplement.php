<?php

namespace App\Filament\Resources\ProductComplementResource\Pages;

use App\Filament\Resources\ProductComplementResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditProductComplement extends EditRecord
{
    protected static string $resource = ProductComplementResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
