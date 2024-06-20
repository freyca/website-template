<?php

declare(strict_types=1);

namespace App\Filament\Admin\Resources\Users\OrderResource\Pages;

use App\Filament\Admin\Resources\Users\OrderResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditOrder extends EditRecord
{
    protected static string $resource = OrderResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
