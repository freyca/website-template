<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Enums\PaymentMethod;
use App\Http\Requests\CheckOutRequest;
use App\Models\UserMetadata;
use Filament\Notifications\Notification;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class CheckOutController extends Controller
{
    public function index(): View|RedirectResponse
    {
        if (Auth::user() === null) {
            return redirect('user');
        }

        return view(
            'pages.checkout',
            [
                'shipping_addresses' => Auth::user()->userMetadata,
            ]
        );
    }

    public function paymentAndShipping(CheckOutRequest $request): RedirectResponse
    {
        if (Auth::user() === null) {
            return redirect('user');
        }

        // Validate address_id belongs to user
        if (
            $request->input('address') !== 'newAddress' &&
            !$this->validateAddressBelongsToUser($request->integer('address'))
        ) {
            Notification::make()->title(__('Invalid address'))->danger()->send();

            return redirect('/checkout', 301)
                ->with(
                    ['shipping_addresses' => Auth::user()->userMetadata]
                );
        }

        $this->createNewAddress($request, Auth::user()->id);

        return match ($request->enum('paymentMethod', PaymentMethod::class)) {
            PaymentMethod::Card => $this->processCardPayment(),
            default => redirect('/finished-purchase')->with(['succcess' => true]),
        };
    }

    private function validateAddressBelongsToUser(int $addressId): bool
    {
        $user = Auth::user();

        return match (true) {
            $user === null => false,
            default => $user->userMetadata->pluck('id')->contains($addressId),
        };
    }

    private function createNewAddress(CheckOutRequest $request, int $userId): void
    {
        UserMetadata::create([
            'user_id' => $userId,
            'address' => $request->string('street')->trim(),
            'city' => $request->string('city')->trim(),
            'postal_code' => $request->integer('postalCode'),
        ]);
    }

    private function processCardPayment(): RedirectResponse
    {
        return redirect('/');
    }
}
