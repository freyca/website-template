<?php

declare(strict_types=1);

namespace App\Filament\Admin\Resources\Users\UserResource\Pages;

use App\Filament\Admin\Resources\Users\UserResource;
use Filament\Resources\Pages\CreateRecord;

class CreateUser extends CreateRecord
{
    protected static string $resource = UserResource::class;
}
