<?php

declare(strict_types=1);

namespace App\Http\Responses;

use App\Services\Cart;
use Filament\Http\Responses\Auth\Contracts\LoginResponse;
use Illuminate\Http\RedirectResponse;
use Livewire\Features\SupportRedirects\Redirector;

class FilamentLoginResponse implements LoginResponse
{
    public function toResponse($request): Redirector|RedirectResponse
    {
        /** @var Cart */
        $cart = app(Cart::class);

        if ($cart->getTotalQuantity() > 0) {
            return redirect()->route('checkout.index');
        }

        return redirect('/user');
    }
}
