<?php

declare(strict_types=1);

namespace App\Filament\Admin\Resources\Products\ProductSparePartResource\Pages;

use App\Filament\Admin\Resources\Products\ProductSparePartResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListProductSpareParts extends ListRecords
{
    protected static string $resource = ProductSparePartResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
