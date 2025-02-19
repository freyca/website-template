<div class="my-6 flex flex-col gap-6">
    @if (count($variants))
        @livewire('product.product-variant-selector', ['variants' => $variants])
    @endif

    @if($can_be_assembled)
        @livewire('buttons.assembly-status', ['product' => $product, 'mandatory_assembly' => $mandatory_assembly])
    @endif

    @if (count($variants))
        @livewire('product.product-price', ['product' => $variants->first()])
    @else
        @livewire('product.product-price', ['product' => $product])
    @endif

    @livewire('buttons.add-to-cart-buttons', ['product' => $product])
</div>
