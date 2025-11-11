<?php

namespace App\Filament\Admin\Resources\Products\DisassemblyResource\Pages;

use Filament\Actions\DeleteAction;
use App\Filament\Admin\Resources\Products\DisassemblyResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditDisassembly extends EditRecord
{
    protected static string $resource = DisassemblyResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
