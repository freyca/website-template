<li>
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
    class="flex-col my-4
    @if ($shouldBeChecked !== true) {{ 'hidden' }} @endif"
    >
    <div class="w-full xl:grid xl:grid-cols-2">
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

        <div class="md:flex md:items-center mb-6 xl:col-span-2">
            <div class="">
                <label class="block text-gray-700 font-bold md:text-right mb-1 md:mb-0 pr-4" for="inline-full-name">
                    Dirección
                </label>
            </div>
            <div class="md:w-full">
                <input class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none" id="inline-full-name" type="text">
            </div>
        </div>
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
