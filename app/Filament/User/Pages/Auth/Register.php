<?php

declare(strict_types=1);

namespace App\Filament\User\Pages\Auth;

use App\Filament\User\Pages\Auth\Traits\HasSurname;
use Filament\Pages\Auth\Register as BaseRegister;

class Register extends BaseRegister
{
    use HasSurname;

    protected function getForms(): array
    {
        return [
            'form' => $this->form(
                $this->makeForm()
                    ->schema([
                        $this->getNameFormComponent(),
                        $this->getSurNameFormComponent(),
                        $this->getEmailFormComponent(),
                        $this->getPasswordFormComponent(),
                        $this->getPasswordConfirmationFormComponent(),
                    ])
                    ->statePath('data'),
            ),
        ];
    }
}
