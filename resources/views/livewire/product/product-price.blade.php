<div>
    @if ($product->price_with_discount)
        <p>
            <span class="text-md font-semibold p-3 px-4 mr-4 rounded-3xl bg-gray-800 text-gray-100">
                {{ $product->getFormattedPriceWithDiscount() }}
            </span>

            <span class="pr-2 text-gray-800">
                {{ __('Before') . ': ' }}
                <span class="line-through font-semibold">
                    {{ $product->getFormattedPrice() }}
                </span>
            </span>
        </p>
        <br/>
        <p class="my-1">
            <span class="text-md font-semibold p-2 px-4 mr-4 rounded-3xl text-gray-800 border-2 border-gray-800">
                {{__('Savings') . ': ' . $product->getFormattedSavings()}}
            </span>
        </p>
    @else
        <span class="text-lg font-bold p-3 px-4 mr-4 rounded-3xl bg-gray-800 text-gray-100">
            {{ $product->getFormattedPrice() }}
        </span>
    @endif
</div>