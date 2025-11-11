<?php

namespace App\Filament\Admin\Resources\Products\Disassemblies\Pages;

use Filament\Actions\DeleteAction;
use App\Filament\Admin\Resources\Products\Disassemblies\DisassemblyResource;
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
