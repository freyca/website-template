<div>
    @if ($product->price_with_discount)
        <p>
            <span class="text-md font-bold p-2 px-4 mr-4 rounded-md bg-primary-500 text-gray-100">
                {{ number_format($product->price_with_discount, 2, ',', '.') }} €
            </span>

            <span class="text-gray-800 pr-2 line-through text-gray-600">
                {{ number_format($product->price, 2, ',', '.') }} €
            </span>
        </p>
    @else
        <span class="text-md font-bold p-2 px-4 mr-4 rounded-md bg-primary-500 text-gray-100">
            {{ number_format($product->price, 2, ',', '.') }} €
        </span>
    @endif
</div>