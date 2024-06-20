<?php

declare(strict_types=1);

namespace App\Filament\User\Pages\Auth\Traits;

use Filament\Forms\Components\Component;
use Filament\Forms\Components\TextInput;

trait HasSurname
{
    protected function getSurNameFormComponent(): Component
    {
        return TextInput::make('surname')
            ->label(__('Surname'))
            ->required()
            ->maxLength(255);
    }
}
