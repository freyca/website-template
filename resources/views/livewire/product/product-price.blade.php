<div>
    @if ($product->price_with_discount)
        <p>
            <span class="text-md font-bold p-2 px-4 mr-4 rounded-md bg-primary-500 text-gray-100">
                {{ $product->price_with_discount }} €
            </span>

            <span class="text-gray-800 pr-2 line-through text-gray-600">
                {{ $product->price }} €
            </span>
        </p>
    @else
        <span class="text-md font-bold p-2 px-4 mr-4 rounded-md bg-primary-500 text-gray-100">
            {{ $product->price }} €
        </span>
    @endif
</div>