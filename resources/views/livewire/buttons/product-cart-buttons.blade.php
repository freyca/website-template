<div class="items-center my-2 xl:my-4">
    @if($can_be_assembled)
        @livewire('buttons.assembly-status', ['product' => $product, 'mandatory_assembly' => $mandatory_assembly])
    @endif

    @if (count($variants))
        @livewire('product.product-variant-selector', ['variants' => $variants])
    @endif

    <div class="my-4">
        @if (count($variants))
            @livewire('product.product-price', ['product' => $variants->first()])
        @else
            @livewire('product.product-price', ['product' => $product])
        @endif
    </div>

    <div class="my-4 justify-center items-center">
        @livewire('buttons.add-to-cart-buttons', ['product' => $product])
    </div>
</div>
