<?php

declare(strict_types=1);

namespace App\Filament\Admin\Resources\Products\ProductComplementResource\Pages;

use App\Filament\Admin\Resources\Products\ProductComplementResource;
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
