<div class="mx-auto mt-6 max-w-4xl flex-1 space-y-6 xl:mb-2 lg:w-full">
    <p class="pt-8 text-xl text-center font-semibold text-gray-900 ">
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

            @php $shouldBeChecked=(count($adresses) === 0); @endphp
            <x-cart.new-address :shouldBeChecked=$shouldBeChecked />
        </ul>
    </div>
</div>