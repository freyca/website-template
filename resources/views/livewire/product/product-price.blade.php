<div>
    @if ($product->price_with_discount)
        <p>
            <span class="text-md font-semibold p-3 px-4 mr-4 rounded-3xl bg-primary-800 text-primary-100">
                {{ $product->getFormattedPriceWithDiscount() }}
            </span>

            <span class="pr-2 text-primary-800">
                {{ __('Before') . ': ' }}
                <span class="line-through font-semibold">
                    {{ $product->getFormattedPrice() }}
                </span>
            </span>
        </p>
    @else
        <p>
            <span class="text-lg font-bold p-3 px-4 mr-4 rounded-3xl bg-primary-800 text-primary-100">
                {{ $product->getFormattedPrice() }}
            </span>
        </p>
    @endif
</div>