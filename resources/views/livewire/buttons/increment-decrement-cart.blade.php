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

    <p class="text-center text-md px-1 font-medium text-gray-900 mx-1">
        @if ($productQuantity < 10)
            &nbsp;{{ $productQuantity }}
        @else
            {{ $productQuantity }}
        @endif
    </p>

    <button wire:click="increment" type="button" id="increment-button" data-input-counter-increment="counter-input"
        class="inline-flex h-5 w-5 shrink-0 items-center justify-center"
        @if ($productQuantity === $product->stock) {{ 'disabled ' }} @endif>

        @if ($productQuantity === $product->stock)
            @svg('heroicon-o-plus-circle')
        @else
            @svg('heroicon-s-plus-circle')
        @endif
    </button>
</div>
