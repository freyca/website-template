<?php

declare(strict_types=1);

namespace App\Filament\User\Resources\UserMetadataResource\Pages;

use App\Filament\User\Resources\UserMetadataResource;
use Filament\Resources\Pages\CreateRecord;

class CreateUserMetadata extends CreateRecord
{
    protected static string $resource = UserMetadataResource::class;
}
