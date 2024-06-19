<?php

declare(strict_types=1);

namespace App\Filament\Resources\Products\ProductResource\Pages;

use App\Filament\Resources\Products\ProductResource;
use Filament\Resources\Pages\CreateRecord;

class CreateProduct extends CreateRecord
{
    protected static string $resource = ProductResource::class;
}
