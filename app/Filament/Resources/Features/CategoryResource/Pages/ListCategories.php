<?php

declare(strict_types=1);

namespace App\Filament\Resources\Features\CategoryResource\Pages;

use App\Filament\Resources\Features\CategoryResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListCategories extends ListRecords
{
    protected static string $resource = CategoryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
