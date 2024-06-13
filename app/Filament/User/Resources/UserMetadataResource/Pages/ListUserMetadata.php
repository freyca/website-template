<?php

namespace App\Filament\User\Resources\UserMetadataResource\Pages;

use App\Filament\User\Resources\UserMetadataResource;
use Filament\Resources\Pages\ListRecords;

class ListUserMetadata extends ListRecords
{
    protected static string $resource = UserMetadataResource::class;

    protected function getHeaderActions(): array
    {
        return [];
    }
}
