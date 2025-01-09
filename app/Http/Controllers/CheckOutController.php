<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Enums\PaymentMethod;
use App\Http\Requests\CheckOutRequest;
use App\Models\Order;
use App\Models\User;
use App\Models\UserMetadata;
use App\Services\Cart;
use App\Services\Payment;
use Filament\Notifications\Notification;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class CheckOutController extends Controller
{
    public function index(): View|RedirectResponse
    {
        $user = Auth::user();

        if ($user === null) {
            return redirect('user');
        }

        /**
         * @var Cart
         */
        $cart = app(Cart::class);

        if ($cart->isEmpty()) {
            return redirect()->route('home');
        }

        return view(
            'pages.checkout',
            [
                'shipping_addresses' => $user->userMetadata,
            ]
        );
    }

    public function paymentAndShipping(CheckOutRequest $request)
    {
        /** @var ?User */
        $user = Auth::user();

        if ($user === null) {
            return redirect('user');
        }

        // If is new address, create it
        if ($request->input('address') === 'newAddress') {
            $address = $this->createNewAddress($request, $user->id);
        } else {
            /** @var UserMetadata */
            $address = UserMetadata::find($request->integer('address'));
        }

        // Validate address_id belongs to user
        if (
            $request->input('address') !== 'newAddress' &&
            ! $this->validateAddressBelongsToUser($address->id, $user)
        ) {
            Notification::make()->title(__('Invalid address'))->danger()->send();

            return redirect('/checkout', 301)
                ->with(
                    ['shipping_addresses' => $user->userMetadata]
                );
        }

        $order = $this->buildOrder($request, $user, $address);

        return $this->processPayment($order);
    }

    private function validateAddressBelongsToUser(int $addressId, User $user): bool
    {
        return $user->userMetadata->pluck('id')->contains($addressId);
    }

    private function createNewAddress(CheckOutRequest $request, int $userId): UserMetadata
    {
        return UserMetadata::create([
            'user_id' => $userId,
            'address' => $request->string('street')->trim(),
            'city' => $request->string('city')->trim(),
            'postal_code' => $request->integer('postalCode'),
        ]);
    }

    private function buildOrder(CheckOutRequest $request, User $user, UserMetadata $userMetadata): Order
    {
        /**
         * @var Cart
         */
        $cart = app(Cart::class);

        return $cart->buildOrder(
            PaymentMethod::from(
                strval($request->string('paymentMethod'))
            ),
            $user,
            $userMetadata
        );
    }

    private function processPayment(Order $order)
    {
        $paymentService = new Payment($order);

        return $paymentService->payPurchase();
    }
}
