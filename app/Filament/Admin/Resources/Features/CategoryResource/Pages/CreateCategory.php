<?php

declare(strict_types=1);

namespace App\Filament\Admin\Resources\Features\CategoryResource\Pages;

use App\Filament\Admin\Resources\Features\CategoryResource;
use Filament\Resources\Pages\CreateRecord;

class CreateCategory extends CreateRecord
{
    protected static string $resource = CategoryResource::class;
}
