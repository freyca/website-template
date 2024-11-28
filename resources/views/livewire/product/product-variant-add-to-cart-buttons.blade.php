<div class="flex mx-auto">
    @if (!$inCart)
        @livewire('buttons.add-to-cart', ['product' => $variant])
    @else
        <div>
            @livewire('buttons.remove-from-cart', ['product' => $variant])
        </div>
        <div class="">
            @livewire('buttons.increment-decrement-cart', ['product' => $variant])
        </div>
    @endif
</div>
