<div class="mx-auto mt-6 max-w-4xl flex-1 space-y-6 xl:mb-2 lg:w-full">
    <div class="rounded-lg border bg-white p-2 shadow-sm md:p-6 space-x-6">
        <p class="text-xl text-center font-semibold text-gray-900 ">
            {{ __('Payment method') }}
        </p>

        <div id="shippingAddress">
            <ul class="mt-6 space-y-3">
                @foreach (App\Enums\PaymentMethod::cases() as $paymentMethod)
                <li>
                    <label for="{{ $paymentMethod->name }}" class="block relative">
                        <input
                            type="radio"
                            id="{{ $paymentMethod->name }}"
                            name="paymentMethod"
                            value="{{ $paymentMethod->value }}"
                            @if ($loop->first) {{ 'checked' }} @endif
                            class="sr-only peer"
                        >
                        <div class="w-full flex gap-x-3 items-start p-4 cursor-pointer rounded-lg border bg-white shadow-sm ring-primary-600 peer-checked:ring-2 duration-200">
                            <div class="flex-none">
                                <div>@svg($paymentMethod->getIcon(), 'w-6 h-6 mx-2')</div>
                            </div>
                            <div>
                                <h3 class="leading-none text-gray-800 font-medium pr-3">
                                    <span>{{ __("$paymentMethod->value") }}</span>
                                </h3>
                            </div>
                        </div>

                        <div class="absolute top-6 right-4 flex-none flex items-center justify-center w-4 h-4 rounded-full border peer-checked:bg-primary-600 text-white peer-checked:text-white duration-200">
                        </div>
                    </label>
                </li>
                @endforeach
            </ul>
        </div>
    </div>
</div>