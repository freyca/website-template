<li class="mb-8 @if (auth()->user() === null) {{ 'hidden' }} @endif">
    <label for="newAddress" class="block relative">
        <input
            type="radio"
            id="newAddress"
            name="address"
            value="newAddress"
            class="sr-only peer"
            @if ($shouldBeChecked === true) {{ 'checked' }} @endif
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


<div id="newAddressForm"
    class="flex-col pt-4
    @if ($shouldBeChecked !== true) {{ 'hidden' }} @endif"
    >
    <div class="w-full xl:grid xl:grid-cols-2 xl:gap-5">
        <div class="md:flex md:items-center mb-6">
            <div class="md:w-1/4">
                <label class="block text-gray-700 font-bold md:text-right mb-1 md:mb-0 pr-4" for="name">
                    {{ __('Name') }}
                </label>
            </div>
            <div class="md:w-full">
                <input class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none" id="name" type="text">
            </div>
        </div>

        <div class="md:flex md:items-center mb-6">
            <div class="md:w-1/4">
                <label class="block text-gray-700 font-bold md:text-right mb-1 md:mb-0 pr-4" for="surname">
                    {{ __('Surname') }}
                </label>
            </div>
            <div class="md:w-full">
                <input class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none" id="surname" type="text">
            </div>
        </div>

        <div class="md:flex md:items-center mb-6">
            <div class="md:w-1/4">
                <label class="block text-gray-700 font-bold md:text-right mb-1 md:mb-0 pr-4" for="cif">
                    {{ __('NIF/CIF') }}
                </label>
            </div>
            <div class="md:w-full">
                <input class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none" id="cif" type="text">
            </div>
        </div>

        <div class="md:flex md:items-center mb-6">
            <div class="md:w-1/4">
                <label class="block text-gray-700 font-bold md:text-right mb-1 md:mb-0 pr-4" for="phone">
                    {{ __('Phone') }}
                </label>
            </div>
            <div class="md:w-full">
                <input class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none" id="phone" type="text">
            </div>
        </div>

        <div class="md:flex md:items-center mb-6 xl:col-span-2">
            <div class="md:w-1/4 xl:w-min">
                <label class="block text-gray-700 font-bold md:text-right mb-1 md:mb-0 pr-4" for="address">
                    {{ __('Address') }}
                </label>
            </div>
            <div class="md:w-full">
                <input class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none" id="address" type="text">
            </div>
        </div>

        <div class="md:flex md:items-center mb-6">
            <div class="md:w-1/4">
                <label class="block text-gray-700 font-bold md:text-right mb-1 md:mb-0 pr-4" for="city">
                    {{ __('City') }}
                </label>
            </div>
            <div class="md:w-full">
                <input class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none" id="city" type="text">
            </div>
        </div>

        <div class="md:flex md:items-center mb-6">
            <div class="md:w-1/4">
                <label class="block text-gray-700 font-bold md:text-right mb-1 md:mb-0 pr-4" for="province">
                    {{ __('Province') }}
                </label>
            </div>
            <div class="md:w-full">
                <input class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none" id="province" type="text">
            </div>
        </div>

        <div class="md:flex md:items-center mb-6">
            <div class="md:w-1/4">
                <label class="block text-gray-700 font-bold md:text-right mb-1 md:mb-0 pr-4" for="zip-code">
                    {{ __('Zip code') }}
                </label>
            </div>
            <div class="md:w-full">
                <input class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none" id="zip-code" type="text">
            </div>
        </div>

        <div class="md:flex md:items-center mb-6">
            <div class="md:w-1/4">
                <label class="block text-gray-700 font-bold md:text-right mb-1 md:mb-0 pr-4" for="country">
                    {{ __('Country') }}
                </label>
            </div>
            <div class="md:w-full">
                <input class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none" id="country" type="text">
            </div>
        </div>
    </div>
</div>

<script>
    function showNewAddressForm() {
        const requiredElements = [
            'name',
            'surname',
            'cif',
            'phone',
            'address',
            'city',
            'province',
            'zip-code',
            'country'
        ];

        if (document.getElementById('newAddress').checked) {
            for (const element of requiredElements) {
                document.getElementById('address').required = true;
                document.getElementById('address').disabled = false;
            }

            document.getElementById('newAddressForm').style.display = 'flex';
        } else {
            for (const element of requiredElements) {
                document.getElementById('address').required = false;
                document.getElementById('address').disabled = true;
            }

            document.getElementById('newAddressForm').style.display = 'none';
        }
    }
</script>
