<?php

declare(strict_types=1);

namespace App\Filament\User\Pages\Auth;

use Filament\Pages\Auth\Login as BaseLogin;
use Illuminate\View\View;

class Login extends BaseLogin
{
    public function render(): View
    {
        return view(
            'filament.user.pages.auth.login',
        )->layout(
            'layouts.app',
            [
                'title' => config('custom.title'),
                'metaDescription' => 'Descripción de la página de registro',
            ]
        );
    }
}
