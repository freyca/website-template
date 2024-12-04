<div class="grid grid-cols-1 items-center my-2 xl:my-4">
    @if (count($variants))
        @livewire('product.product-variant-selector', ['variants' => $variants])
        <br />
    @endif

    <div class="my-2 xl:my-4">
        @if (count($variants))
            @livewire('product.product-variant-price', ['variant' => $variants->first()])
        @else
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
                <span class="text-md font-bold text-primary-500">
                    {{ $product->price }} €
                </span>
            @endif
        @endif
    </div>

    <div class="col-span-2 justify-center items-center">
        @if (count($variants))
            @livewire('product.product-variant-add-to-cart-buttons', ['variant' => $variants->first()])
        @else
            @livewire('product.product-buttons', ['product' => $product])
        @endif
    </div>
</div>
