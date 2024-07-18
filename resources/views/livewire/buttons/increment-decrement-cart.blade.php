<div class="flex items-center justify-center">

    @php
        $decrementButton = $productQuantity <= 1 ? 'remove' : 'decrement';
    @endphp

    <button wire:click="{{ $decrementButton }}" type="button" id="decrement-button"
        data-input-counter-decrement="counter-input"
        class="inline-flex h-5 w-5 shrink-0 items-center justify-center hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-gray-100">
        @if ($productQuantity <= 1)
            @svg('heroicon-s-trash', 'h-4 w-4')
        @else
            @svg('heroicon-s-minus-circle')
        @endif
    </button>

    <input type="text" id="counter-input" data-input-counter
        class="w-10 shrink-0 border-0 bg-transparent text-center text-sm font-medium text-gray-900 focus:outline-none focus:ring-0"
        placeholder="" value="{{ $productQuantity }}" required />

    <button wire:click="increment" type="button" id="increment-button" data-input-counter-increment="counter-input"
        class="inline-flex h-5 w-5 shrink-0 items-center justify-center hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-gray-100">
        @svg('heroicon-s-plus-circle')
    </button>
</div>
