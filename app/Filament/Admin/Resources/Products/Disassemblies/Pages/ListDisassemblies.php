<?php

namespace App\Filament\Admin\Resources\Products\Disassemblies\Pages;

use Filament\Actions\CreateAction;
use App\Filament\Admin\Resources\Products\Disassemblies\DisassemblyResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListDisassemblies extends ListRecords
{
    protected static string $resource = DisassemblyResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
