<?php

declare(strict_types=1);

namespace App\Filament\Resources\Features\ProductFeatureResource\Pages;

use App\Filament\Resources\Features\ProductFeatureResource;
use Filament\Resources\Pages\CreateRecord;

class CreateProductFeature extends CreateRecord
{
    protected static string $resource = ProductFeatureResource::class;
}