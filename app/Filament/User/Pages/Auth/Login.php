<?php

declare(strict_types=1);

namespace App\Filament\User\Pages\Auth;

use App\DTO\SeoTags;
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
                'seotags' => new SeoTags('noindex'),
            ]
        );
    }
}
