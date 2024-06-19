<?php

declare(strict_types=1);

namespace App\Filament\Resources\Products\ProductComplementResource\Pages;

use App\Filament\Resources\Products\ProductComplementResource;
use Filament\Resources\Pages\CreateRecord;

class CreateProductComplement extends CreateRecord
{
    protected static string $resource = ProductComplementResource::class;
}
