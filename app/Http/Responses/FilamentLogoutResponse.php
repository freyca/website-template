<?php

declare(strict_types=1);

namespace App\Http\Responses;

use Filament\Http\Responses\Auth\Contracts\LogoutResponse;
use Illuminate\Http\RedirectResponse;

class FilamentLogoutResponse implements LogoutResponse
{
    public function toResponse($request): RedirectResponse
    {
        return redirect()->route('home');
    }
}
