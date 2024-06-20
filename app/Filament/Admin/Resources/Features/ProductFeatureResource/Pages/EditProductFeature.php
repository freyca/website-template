<?php

declare(strict_types=1);

namespace App\Filament\Admin\Resources\Features\ProductFeatureResource\Pages;

use App\Filament\Admin\Resources\Features\ProductFeatureResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditProductFeature extends EditRecord
{
    protected static string $resource = ProductFeatureResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
