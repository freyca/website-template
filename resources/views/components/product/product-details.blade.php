<div class="grid grid-cols-1 items-center my-2 xl:my-4">
    @if (count($variants))
        @livewire('product.product-variant-selector', ['variants' => $variants])
        <br />
    @endif

    <div class="my-2 xl:my-4">
        @if (count($variants))
            @livewire('product.product-price', ['product' => $variants->first()])
        @else
            @livewire('product.product-price', ['product' => $product])
        @endif
    </div>

    <div class="col-span-2 justify-center items-center">
        @if (count($variants))
            @livewire('product.add-to-cart-buttons', ['product' => $variants->first()])
        @else
            @livewire('product.add-to-cart-buttons', ['product' => $product])
        @endif
    </div>
</div>
