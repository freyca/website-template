<div class="flex mx-auto">
    @if (!$inCart)
        @livewire('buttons.add-to-cart', ['product' => $product])
    @else
        <div class="mx-auto">
            @livewire('buttons.increment-decrement-cart', ['product' => $product])
        </div>
        <div>
            @livewire('buttons.remove-from-cart', ['product' => $product])
        </div>
    @endif
</div>
