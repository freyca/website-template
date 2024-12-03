<x-layouts.app title="{{ config('custom.title') }}" metaDescription="Metadescripcion de la pagina de checkout">

    <form method="POST" action="/checkout" class="mx-auto max-w-screen-xl px-4 2xl:px-0 my-4">
        @csrf {{ csrf_field() }}

        <h2 class="text-xl font-semibold text-gray-900 sm:text-2xl">
            {{ __('Select payment method') }}
        </h2>

        <fieldset class="mx-auto max-w-screen-xl px-4 2xl:px-0 my-4">
            <legend class="sr-only">{{ __('Payment methods') }}</legend>

            @foreach (App\Enums\PaymentMethod::cases() as $paymentMethod)
                <div class="flex items-center mb-4">
                    <input id="{{ $paymentMethod->name }}" type="radio" name="paymentMethod"
                        value="{{ $paymentMethod->value }}" class="w-4 h-4 border-gray-300"
                        @if ($loop->first) {{ 'checked' }} @endif>

                    <label for="{{ $paymentMethod->name }}" class="block ms-2 text-sm font-medium text-gray-900">
                        {{ __($paymentMethod->value) }}
                    </label>
                </div>
            @endforeach
        </fieldset>

        <h2 class="text-xl font-semibold text-gray-900 sm:text-2xl">
            {{ __('Select shipping address') }}
        </h2>

        <fieldset class="mx-auto max-w-screen-xl px-4 2xl:px-0 my-4" onclick="showNewAddressForm();">
            <legend class="sr-only">{{ __('Payment methods') }}</legend>

            @foreach ($shipping_addresses as $shipping_address)
                <div class="flex items-center mb-4">
                    <input id="{{ md5($shipping_address->address) }}" type="radio" name="address"
                        value="{{ $shipping_address->id }}" class="w-4 h-4 border-gray-300"
                        @if ($loop->first) {{ 'checked' }} @endif />

                    <label for="{{ md5($shipping_address->address) }}"
                        class="block ms-2 text-sm font-medium text-gray-900">
                        {{ $shipping_address->address . ', ' . $shipping_address->city . ', ' . $shipping_address->postal_code }}
                    </label>
                </div>
            @endforeach

            <div class="items-center mb-4">
                <input id="newAddress" type="radio" name="address" value="newAddress" class="w-4 h-4 border-gray-300"
                    @if (count($shipping_addresses) === 0) {{ 'checked' }} @endif />
                <label for="newAddress" class="ms-2 text-sm font-medium text-gray-900">
                    {{ __('New address') }}
                </label>

                <div class="flex-col my-4 max-w-lg @if (count($shipping_addresses) !== 0) {{ 'hidden' }} @endif"
                    id="newAddressForm">
                    <div class="mb-4">
                        <label for="address"
                            class="block mb-2 text-sm font-medium text-gray-900">{{ __('Address') }}</label>
                        <input @if (count($shipping_addresses) !== 0) {{ 'disabled' }} @endif type="text"
                            id="address" name="street"
                            class="block w-full p-2 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 text-xs focus:ring-blue-500 focus:border-blue-500" />
                    </div>

                    <div class="mb-4">
                        <label for="city"
                            class="block mb-2 text-sm font-medium text-gray-900">{{ __('City') }}</label>
                        <input @if (count($shipping_addresses) !== 0) {{ 'disabled' }} @endif type="text"
                            id="city" name="city"
                            class="block w-full p-2 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 text-xs focus:ring-blue-500 focus:border-blue-500" />
                    </div>

                    <div class="mb-4">
                        <label for="postalCode"
                            class="block mb-2 text-sm font-medium text-gray-900">{{ __('Postal code') }}</label>
                        <input @if (count($shipping_addresses) !== 0) {{ 'disabled' }} @endif type="number"
                            id="postalCode" name="postalCode"
                            class="block w-full p-2 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 text-xs focus:ring-blue-500 focus:border-blue-500" />
                    </div>
                </div>
            </div>

        </fieldset>


        <button type="submit"
            class="inline shadow bg-gray-500 hover:bg-gray-400 active:translate-x-1 active:translate-y-1 text-white font-bold py-2 px-4 rounded">
            {{ __('Continue') }}
        </button>
    </form>

    <script>
        function showNewAddressForm() {
            if (document.getElementById('newAddress').checked) {
                // Make elements required
                document.getElementById('address').required = true;
                document.getElementById('city').required = true;
                document.getElementById('postalCode').required = true;

                // Enable options
                document.getElementById('address').disabled = false;
                document.getElementById('city').disabled = false;
                document.getElementById('postalCode').disabled = false;

                document.getElementById('newAddressForm').style.display = 'flex';
            } else {
                document.getElementById('newAddressForm').style.display = 'none';

                // Does not make it required
                document.getElementById('address').required = false;
                document.getElementById('city').required = false;
                document.getElementById('postalCode').required = false;

                // Disable elements
                document.getElementById('address').disabled = true;
                document.getElementById('city').disabled = true;
                document.getElementById('postalCode').disabled = true;
            }
        }
    </script>
</x-layouts.app>
