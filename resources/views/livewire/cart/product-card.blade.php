@inject('cart', 'App\Services\Cart')

@php
    $path = match (true) {
        get_class($product) === 'App\Models\ProductSparePart' => '/pieza-de-repuesto',
        get_class($product) === 'App\Models\ProductComplement' => '/complemento',
        default => '/producto',
    };
@endphp

<div class="rounded-lg border border-gray-200 bg-gray-400 p-4 shadow-sm md:p-6 space-x-6">
    <div class="space-y-4 grid grid-cols-3 md:flex md:items-center md:justify-between md:gap-6 md:space-y-0 ">
        <a href="{{ $path . '/' . $product->slug }}" class="shrink-0 md:order-1">
            <img class=" mx-auto h-20 w-20 xl:h-32 xl:w-32 rounded-full object-contain"
                src="{{ @asset('/storage/' . $product->main_image) }}" alt="" />
        </a>

        <div class="ml-2 sm:ml-0 w-full min-w-0 flex-1 space-y-4 col-span-2 md:order-2 md:max-w-md">
            <div>
                <a href="{{ $path . '/' . $product->slug }}" class="text-base font-medium text-gray-900 hover:underline">
                    {{ $product->name }}
                </a>
                <p class="text-base text-gray-900 truncate">
                    {{ $product->slogan }}
                </p>
            </div>
        </div>

        <hr class="col-span-3" md:hidden>

        <div class="flex col-span-2 justify-around md:order-4 md:grid">
            <div class="flex items-center justify-between md:justify-center ">
                <div class="flex items-center justify-center">
                    <button wire:click="decrement" type="button" id="decrement-button"
                        data-input-counter-decrement="counter-input"
                        class="inline-flex h-5 w-5 shrink-0 items-center justify-center hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-gray-100">
                        @svg('heroicon-s-minus-circle')
                    </button>

                    <input type="text" id="counter-input" data-input-counter
                        class="w-10 shrink-0 border-0 bg-transparent text-center text-sm font-medium text-gray-900 focus:outline-none focus:ring-0"
                        placeholder="" value="{{ $cart->getTotalQuantityForProduct($product) }}" required />

                    <button wire:click="increment" type="button" id="increment-button"
                        data-input-counter-increment="counter-input"
                        class="inline-flex h-5 w-5 shrink-0 items-center justify-center hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-gray-100">
                        @svg('heroicon-s-plus-circle')
                    </button>
                </div>
            </div>

            <div class="flex items-center gap-4">
                @livewire('buttons.remove-from-cart', ['product' => $product])
            </div>
        </div>

        <div class="text-center self-center md:order-3 md:w-32">
            <p class="text-base font-bold text-gray-900">{{ $cart->getTotalCostforProduct($product, true) }}</p>
        </div>

    </div>
</div>
