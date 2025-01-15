<div>
    <p class="pt-8 text-xl font-semibold text-gray-900 ">
        {{ __('Shipping address') }}
    </p>

    <div id="shippingAddress">
        <ul class="mt-6 space-y-3" onclick="showNewAddressForm();">
            @foreach ($adresses as $shipping_address)
            <li>
                <label for="{{ $shipping_address->address }}" class="block relative">
                    <input
                        type="radio"
                        id="{{ $shipping_address->address }}"
                        name="address"
                        value="{{ $shipping_address->id }}"
                        @if ($loop->first) {{ 'checked' }} @endif
                        class="sr-only peer"
                    >
                    <div class="w-full flex gap-x-3 items-start p-4 cursor-pointer rounded-lg border bg-white shadow-sm ring-primary-600 peer-checked:ring-2 duration-200">
                        <div class="flex-none">
                            <div>@svg('heroicon-m-home', 'w-6 h-6 mx-2')</div>
                        </div>
                        <div>
                            <h3 class="leading-none text-gray-800 font-medium pr-3">
                                <span>{{$shipping_address->address . ', '}}</span>
                                <span>{{ $shipping_address->postal_code . ' ' . $shipping_address->city }}</span>
                            </h3>
                        </div>
                    </div>

                    <div class="absolute top-6 right-4 flex-none flex items-center justify-center w-4 h-4 rounded-full border peer-checked:bg-primary-600 text-white peer-checked:text-white duration-200">
                    </div>
                </label>
            </li>
            @endforeach

            <li>
                <label for="newAddress" class="block relative">
                    <input
                        type="radio"
                        id="newAddress"
                        name="address"
                        value="newAddress"
                        class="sr-only peer"
                        @if (count($adresses) === 0) {{ 'checked' }} @endif
                    >
                    <div class="w-full flex gap-x-3 items-start p-4 cursor-pointer rounded-lg border bg-white shadow-sm ring-primary-600 peer-checked:ring-2 duration-200">
                        <div class="flex-none">
                            <div>@svg('heroicon-m-home', 'w-6 h-6 mx-2')</div>
                        </div>
                        <div>
                            <h3 class="leading-none text-gray-800 font-medium pr-3">
                                <div class="mb-1">{{ __('New address')}}</div>
                            </h3>
                        </div>
                    </div>

                    <div class="absolute top-6 right-4 flex-none flex items-center justify-center w-4 h-4 rounded-full border peer-checked:bg-primary-600 text-white peer-checked:text-white duration-200">
                    </div>
                </label>
            </li>
        </ul>
    </div>

    <div id="newAddressForm"
        class="flex-col my-4 max-w-lg @if (count($adresses) !== 0) {{ 'hidden' }} @endif"
        >



        <div class="w-full max-w-sm">

            <div class="md:flex md:items-center mb-6">
                <div class="md:w-1/3">
                    <label class="block text-gray-700 font-bold md:text-right mb-1 md:mb-0 pr-4" for="inline-full-name">
                        Dirección
                    </label>
                </div>
                <div class="md:w-2/3">
                    <input class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none" id="inline-full-name" type="text">
                </div>
            </div>

            <div class="md:flex md:items-center mb-6">
                <div class="md:w-1/3">
                    <label class="block text-gray-700 font-bold md:text-right mb-1 md:mb-0 pr-4" for="inline-full-name">
                        Ciudad
                    </label>
                </div>
                <div class="md:w-2/3">
                    <input class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none" id="inline-full-name" type="text">
                </div>
            </div>

            <div class="md:flex md:items-center mb-6">
                <div class="md:w-1/3">
                    <label class="block text-gray-700 font-bold md:text-right mb-1 md:mb-0 pr-4" for="inline-full-name">
                        Código postal
                    </label>
                </div>
                <div class="md:w-2/3">
                    <input class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none" id="inline-full-name" type="text">
                </div>
            </div>
        </div>



        <div class="mb-4">
            <label for="address"
                class="block mb-2 text-sm font-medium text-gray-900">{{ __('Address') }}</label>
            <input @if (count($adresses) !== 0) {{ 'disabled' }} @endif type="text"
                id="address" name="street"
                class="block w-full p-2 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 text-xs focus:ring-blue-500 focus:border-blue-500" />
        </div>

        <div class="mb-4">
            <label for="city"
                class="block mb-2 text-sm font-medium text-gray-900">{{ __('City') }}</label>
            <input @if (count($adresses) !== 0) {{ 'disabled' }} @endif type="text"
                id="city" name="city"
                class="block w-full p-2 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 text-xs focus:ring-blue-500 focus:border-blue-500" />
        </div>

        <div class="mb-4">
            <label for="postalCode"
                class="block mb-2 text-sm font-medium text-gray-900">{{ __('Postal code') }}</label>
            <input @if (count($adresses) !== 0) {{ 'disabled' }} @endif type="number"
                id="postalCode" name="postalCode"
                class="block w-full p-2 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 text-xs focus:ring-blue-500 focus:border-blue-500" />
        </div>
    </div>

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
</div>