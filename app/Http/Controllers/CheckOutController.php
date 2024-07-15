<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Enums\PaymentMethod;
use App\Http\Requests\CheckOutRequest;
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

    public function paymentAndShipping(CheckOutRequest $request): ?RedirectResponse
    {
        $paymentMethod = PaymentMethod::from((string) $request->string('paymentMethod'));

        if (Auth::user() === null) {
            return redirect('user');
        }

        return null;
        // Validar que el id de direccion pertenece al usuario
    }
}
