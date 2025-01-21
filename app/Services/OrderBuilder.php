<?php

namespace App\Services;

use App\Enums\PaymentMethod;
use App\Models\User;
use App\Models\Address;
use Illuminate\Support\Facades\Auth;
use App\Models\Order as OrderModel;

class OrderBuilder
{
    private ?User $user;

    private OrderModel $order;

    function __construct()
    {
        $this->user = Auth::user();
    }

    public function build()
    {
        if ($this->user === null) {
            return redirect('user');
        }

        // If is new address, create it
        if ($request->input('address') === 'newAddress') {
            $address = $this->createNewAddress($request, $user->id);
        } else {
            /** @var Address */
            $address = Address::find($request->integer('address'));
        }

        // Validate address_id belongs to user
        if (
            $request->input('address') !== 'newAddress' &&
            ! $this->validateAddressBelongsToUser($address->id, $user)
        ) {
            Notification::make()->title(__('Invalid address'))->danger()->send();

            return redirect('/checkout', 301)
                ->with(
                    ['shipping_addresses' => $user->addresses]
                );
        }

        $order = $this->buildOrder($request, $user, $address);

        return $this->processPayment($order);
    }

    private function validateAddressBelongsToUser(int $addressId): bool
    {
        return $this->user->address->pluck('id')->contains($addressId);
    }

    private function createNewAddress(): Address
    {
        return Address::create([
            'user_id' => $this->user->id,
            'address' => $request->string('street')->trim(),
            'city' => $request->string('city')->trim(),
            'postal_code' => $request->integer('postalCode'),
        ]);
    }

    private function buildOrder(): void
    {
        /**
         * @var Cart
         */
        $cart = app(Cart::class);

        $this->order = $cart->buildOrder(
            PaymentMethod::from(
                strval($request->string('paymentMethod'))
            ),
            $this->user,
            $this->address
        );
    }

    private function processPayment()
    {
        $paymentService = new Payment($this->order);

        return $paymentService->payPurchase();
    }
}
