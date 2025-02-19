<div class="flex items-center justify-center m-2">

    @php
        $decrementButton = $productQuantity <= 1 ? 'remove' : 'decrement';
    @endphp

    <button wire:click="{{ $decrementButton }}" type="button" id="decrement-button"
        data-input-counter-decrement="counter-input" class="inline-flex h-5 w-5 shrink-0 items-center justify-center"
        @if ($productQuantity <= 1) {{ 'disabled ' }} @endif>

        @if ($productQuantity <= 1)
            @svg('heroicon-o-minus-circle')
        @else
            @svg('heroicon-s-minus-circle')
        @endif
    </button>

    <p class="text-center text-md px-1 font-medium text-primary-900 mx-1">
        @if ($productQuantity < 10)
            &nbsp;
        @endif
        {{ $productQuantity }}
    </p>

    @php
        $cart = app(\App\Services\Cart::class);
    @endphp
    <button wire:click="increment" type="button" id="increment-button" data-input-counter-increment="counter-input"
        class="inline-flex h-5 w-5 shrink-0 items-center justify-center"
        @if (!$cart->canBeIncremented($product)) {{ 'disabled ' }} @endif>

        @if (!$cart->canBeIncremented($product))
            @svg('heroicon-o-plus-circle')
        @else
            @svg('heroicon-s-plus-circle')
        @endif
    </button>
</div>
