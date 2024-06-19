<?php

declare(strict_types=1);

namespace App\Filament\Resources\Users\OrderResource\Pages;

use App\Filament\Resources\Users\OrderResource;
use Filament\Resources\Pages\CreateRecord;

class CreateOrder extends CreateRecord
{
    protected static string $resource = OrderResource::class;
}
