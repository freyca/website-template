<div>
    @if ($product->price_with_discount)
        <p>
            <span class="text-lg font-bold p-3 px-4 mr-4 rounded-md bg-primary-500 text-gray-100">
                {{ $product->getFormattedPriceWithDiscount() }}
            </span>

            <span class="text-gray-800 pr-2 line-through text-gray-600">
                {{ $product->getFormattedPrice() }}
            </span>
        </p>
        <br/>
        <p>
            <span class="text-lg font-bold p-3 px-4 mr-4 rounded-md bg-green-500 text-gray-100">
                Te estás ahorrando {{ $product->getFormattedSavings() }}
            </span>
        </p>
    @else
        <span class="text-lg font-bold p-3 px-4 mr-4 rounded-md bg-primary-500 text-gray-100">
            {{ $product->getFormattedPrice() }}
        </span>
    @endif
</div>