<?php

declare(strict_types=1);

namespace App\Filament\User\Pages\Auth;

use Filament\Schemas\Schema;
use App\Filament\User\Pages\Auth\Traits\HasSurname;

class EditProfile extends \Filament\Auth\Pages\EditProfile
{
    use HasSurname;

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                $this->getNameFormComponent(),
                $this->getSurNameFormComponent(),
                $this->getEmailFormComponent(),
                $this->getPasswordFormComponent(),
                $this->getPasswordConfirmationFormComponent(),
            ]);
    }
}
