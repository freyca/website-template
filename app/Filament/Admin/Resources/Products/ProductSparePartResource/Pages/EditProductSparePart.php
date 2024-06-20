<?php

declare(strict_types=1);

namespace App\Filament\Admin\Resources\Products\ProductSparePartResource\Pages;

use App\Filament\Admin\Resources\Products\ProductSparePartResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditProductSparePart extends EditRecord
{
    protected static string $resource = ProductSparePartResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
