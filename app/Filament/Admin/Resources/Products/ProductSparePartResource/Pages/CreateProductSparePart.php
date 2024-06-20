<?php

declare(strict_types=1);

namespace App\Filament\Admin\Resources\Products\ProductSparePartResource\Pages;

use App\Filament\Admin\Resources\Products\ProductSparePartResource;
use Filament\Resources\Pages\CreateRecord;

class CreateProductSparePart extends CreateRecord
{
    protected static string $resource = ProductSparePartResource::class;
}
