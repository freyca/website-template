<?php

declare(strict_types=1);

namespace App\Http\Responses;

use App\Enums\Role;
use App\Services\Cart;
use Filament\Http\Responses\Auth\Contracts\LoginResponse;
use Illuminate\Http\RedirectResponse;
use Livewire\Features\SupportRedirects\Redirector;
use Filament\Facades\Filament;
use Illuminate\Support\Facades\Auth;

class FilamentLoginResponse implements LoginResponse
{
    public function toResponse($request): Redirector|RedirectResponse
    {
        if (Auth::user()->role === Role::Admin) {
            return redirect()->intended(Filament::getUrl());
        }

        /** @var Cart */
        $cart = app(Cart::class);

        if ($cart->getTotalQuantity() > 0) {
            return redirect()->route('checkout.cart');
        }

        return redirect('/user');
    }
}
