<?php

declare(strict_types=1);

namespace App\Filament\Resources\Features\CategoryResource\Pages;

use App\Filament\Resources\Features\CategoryResource;
use Filament\Resources\Pages\CreateRecord;

class CreateCategory extends CreateRecord
{
    protected static string $resource = CategoryResource::class;
}
