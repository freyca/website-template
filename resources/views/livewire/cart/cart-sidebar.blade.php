@inject('cart', 'App\Services\Cart')

<div class="mx-auto mt-6 max-w-4xl flex-1 space-y-6 lg:mt-0 lg:w-full">

    <div class="space-y-4 rounded-lg border border-gray-200 bg-white p-4 shadow-sm dark:border-gray-700 dark:bg-gray-800 sm:p-6">
        <p class="text-xl font-semibold text-gray-900 dark:text-white">
            Order summary
        </p>

        <div class="space-y-4">
            <div class="space-y-2">
                <dl class="flex items-center justify-between gap-4">
                    <dt class="text-base font-normal text-gray-500 dark:text-gray-400">
                        Original price
                    </dt>
                    <dd class="text-base font-medium text-gray-900 dark:text-white">
                        $7,592.00
                    </dd>
                </dl>

                <dl class="flex items-center justify-between gap-4">
                    <dt class="text-base font-normal text-gray-500 dark:text-gray-400">
                        Savings
                    </dt>
                    <dd class="text-base font-medium text-tertiary-600">
                        -$299.00
                    </dd>
                </dl>

                <dl class="flex items-center justify-between gap-4">
                    <dt class="text-base font-normal text-gray-500 dark:text-gray-400">
                        Store Pickup
                    </dt>
                    <dd class="text-base font-medium text-gray-900 dark:text-white">
                        $99
                    </dd>
                </dl>

                <dl class="flex items-center justify-between gap-4">
                    <dt class="text-base font-normal text-gray-500 dark:text-gray-400">
                        Tax
                    </dt>
                    <dd class="text-base font-medium text-gray-900 dark:text-white">
                        $799
                    </dd>
                </dl>
            </div>

            <dl class="flex items-center justify-between gap-4 border-t border-gray-200 pt-2 dark:border-gray-700">
                <dt class="text-base font-bold text-gray-900 dark:text-white">
                    Total
                </dt>
                <dd class="text-base font-bold text-gray-900 dark:text-white">
                    {{ $cart->getTotalCost(true) }}
                </dd>
            </dl>
        </div>

        <a href="/checkout" class="flex w-full items-center justify-center rounded-lg bg-tertiary-500 px-5 py-2.5 text-sm font-medium text-white hover:bg-tertiary-800 focus:outline-none focus:ring-4 focus:ring-tertiary-300 dark:bg-tertiary-600 dark:hover:bg-tertiary-700 dark:focus:ring-tertiary-800">
            Proceed to Checkout
        </a>

        <div class="flex items-center justify-center gap-2">
            <span class="text-sm font-normal text-gray-500 dark:text-gray-400"> or </span>
            <a href="/" title="" class="inline-flex items-center gap-2 text-sm font-medium text-tertiary-700 underline hover:no-underline dark:text-tertiary-500">
                Continue Shopping
                <svg class="h-5 w-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 12H5m14 0-4 4m4-4-4-4" />
                </svg>
            </a>
        </div>
    </div>

    <div class="space-y-4 rounded-lg border border-gray-200 bg-white p-4 shadow-sm dark:border-gray-700 dark:bg-gray-800 sm:p-6">
        <form class="space-y-4">
            <div>
                <label for="voucher" class="mb-2 block text-sm font-medium text-gray-900 dark:text-white">
                    Do you have a voucher or gift card?
                </label>
                <input type="text" id="voucher" class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 focus:border-tertiary-500 focus:ring-tertiary-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder:text-gray-400 dark:focus:border-tertiary-500 dark:focus:ring-tertiary-500" placeholder="" required />
            </div>

            <button type="submit" class="flex w-full items-center justify-center rounded-lg bg-tertiary-500 px-5 py-2.5 text-sm font-medium text-white hover:bg-tertiary-800 focus:outline-none focus:ring-4 focus:ring-tertiary-300 dark:bg-tertiary-600 dark:hover:bg-tertiary-700 dark:focus:ring-tertiary-800">
                Apply Code
            </button>
        </form>
    </div>
</div>