<div>
    <p>
        <span class="text-md font-semibold p-3 px-4 mr-4 rounded text-primary-100 bg-primary-800">
            @if ($product->price_with_discount)
                {{ $product->getFormattedPriceWithDiscount() }}
            @else
                {{ $product->getFormattedPrice() }}
            @endif
        </span>

        @if ($product->price_with_discount)
            <span class="pr-2 text-primary-800">
                {{ __('Before') . ': ' }}
                <span class="line-through font-semibold">
                    {{ $product->getFormattedPrice() }}
                </span>
            </span>
        @endif
    </p>
</div>