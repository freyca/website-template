@inject('cart', 'App\Services\Cart')

<div class="my-6 sm:mt-8 max-w-4xl flex-1 space-y-6 xl:mt-6 lg:w-full">

    <div class="space-y-4 rounded-lg border border-gray-200 bg-white p-4 shadow-sm sm:p-6">
        <p class="text-xl font-semibold text-gray-900 ">
            {{ __('Order summary') }}
        </p>

        <div class="space-y-4">
            @if ($cart->getTotalDiscount() > 0)
                <div class="space-y-2">
                    <dl class="flex items-center justify-between gap-4">
                        <dt class="text-base font-normal text-gray-500">
                            {{ __('Precio') }}
                        </dt>
                        <dd class="text-base font-medium text-gray-900">
                            {{ $cart->getTotalCostWithoutDiscount(true) }}
                        </dd>
                    </dl>

                    <dl class="flex items-center justify-between gap-4">
                        <dt class="text-base font-normal text-gray-500">
                            {{ __('Savings') }}
                        </dt>
                        <dd class="text-base font-medium text-green-600">
                            - {{ $cart->getTotalDiscount(true) }}
                        </dd>
                    </dl>
                </div>
            @endif

            <dl class="flex items-center justify-between gap-4 border-t border-gray-200 pt-2">
                <dt class="text-base font-bold text-gray-900">
                    {{ __('Total') }}
                </dt>
                <dd class="text-base font-bold text-gray-900">
                    {{ $cart->getTotalCost(true) }}
                </dd>
            </dl>
        </div>

        <a href="/checkout"
            class="flex w-full items-center justify-center rounded-lg bg-gray-500 px-5 py-2.5 text-sm font-medium text-white hover:bg-gray-800 focus:outline-none focus:ring-4 focus:ring-gray-300">
            {{ __('Proceed to Checkout') }}
        </a>

        <div class="flex items-center justify-center gap-2">
            <span class="text-sm font-normal text-gray-500"> {{ __('or') }} </span>
            <a href="/" title=""
                class="inline-flex items-center gap-2 text-sm font-medium text-gray-700 underline hover:no-underline">
                {{ __('Continue shopping') }}
                @svg('heroicon-s-arrow-right-circle', 'w-5 h-5')
            </a>
        </div>
    </div>

    {{-- <div class="space-y-4 rounded-lg border border-gray-200 bg-white p-4 shadow-sm sm:p-6"> --}}
    {{--    <form class="space-y-4"> --}}
    {{--        <div> --}}
    {{--            <label for="voucher" class="mb-2 block text-sm font-medium text-gray-900"> --}}
    {{--                Do you have a voucher or gift card? --}}
    {{--            </label> --}}
    {{--            <input type="text" id="voucher" --}}
    {{--                class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 focus:border-gray-500 focus:ring-gray-500" --}}
    {{--                placeholder="" required /> --}}
    {{--        </div> --}}
    {{-- --}}
    {{--        <button type="submit" --}}
    {{--            class="flex w-full items-center justify-center rounded-lg bg-gray-500 px-5 py-2.5 text-sm font-medium text-white hover:bg-gray-800 focus:outline-none focus:ring-4 focus:ring-gray-300"> --}}
    {{--            Apply Code --}}
    {{--        </button> --}}
    {{--    </form> --}}
    {{-- </div> --}}
</div>
