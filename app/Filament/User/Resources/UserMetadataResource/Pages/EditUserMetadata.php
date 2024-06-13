<?php

namespace App\Filament\User\Resources\UserMetadataResource\Pages;

use App\Filament\User\Resources\UserMetadataResource;
use Filament\Resources\Pages\EditRecord;

class EditUserMetadata extends EditRecord
{
    protected static string $resource = UserMetadataResource::class;

    protected function getHeaderActions(): array
    {
        return [];
    }
}
