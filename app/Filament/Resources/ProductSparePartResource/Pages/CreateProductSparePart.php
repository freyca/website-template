<?php

declare(strict_types=1);

namespace App\Filament\Resources\ProductSparePartResource\Pages;

use App\Filament\Resources\ProductSparePartResource;
use Filament\Resources\Pages\CreateRecord;

class CreateProductSparePart extends CreateRecord
{
    protected static string $resource = ProductSparePartResource::class;
}
