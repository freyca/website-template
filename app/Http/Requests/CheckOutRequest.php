<?php

declare(strict_types=1);

namespace App\Http\Requests;

use App\Enums\PaymentMethod;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CheckOutRequest extends FormRequest
{
    /**
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'paymentMethod' => ['required', Rule::enum(PaymentMethod::class)],
            'address' => 'required',
            'street' => 'sometimes|string|max:255',
            'city' => 'sometimes|string|max:30',
            'postalCode' => 'sometimes|max:10',
        ];
    }
}
