<div class="flex">
    @if (!$inCart)
        @livewire('buttons.add-to-cart', ['product' => $product])
    @else
        @livewire('buttons.increment-decrement-cart', ['product' => $product])
        @livewire('buttons.remove-from-cart', ['product' => $product])
    @endif
</div>
