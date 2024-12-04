@inject('cart', 'App\Services\Cart')

@php
    $path = match (true) {
        get_class($product) === 'App\Models\ProductSparePart' => '/pieza-de-repuesto',
        get_class($product) === 'App\Models\ProductComplement' => '/complemento',
        default => '/producto',
    };

    if(is_a($product, 'App\Models\ProductVariant')) {
        $parent = $product->product;
    }
@endphp

<div class="mx-auto mt-6 max-w-4xl flex-1 space-y-6 xl:mb-2 lg:w-full">
    <div class="rounded-lg border bg-white p-2 shadow-sm md:p-6 space-x-6">
        <div class="space-y-4 grid grid-cols-3 md:flex md:items-center md:justify-between md:gap-6 md:space-y-0 ">

            <a href="{{ $path . '/' . $product->slug }}" class="shrink-0 md:order-1">
                @if(isset($parent))
                    <img class=" mx-auto h-20 w-20 xl:h-32 xl:w-32 object-contain"
                        src="{{ @asset('/storage/' . $parent->main_image) }}" alt="" />
                @else
                    <img class=" mx-auto h-20 w-20 xl:h-32 xl:w-32 object-contain"
                        src="{{ @asset('/storage/' . $product->main_image) }}" alt="" />
                @endif
            </a>

            <div class="ml-2 sm:ml-0 w-full min-w-0 flex-1 space-y-4 col-span-2 md:order-2 md:max-w-md">
                <div>
                    <a href="{{ $path . '/'}}{{isset($product->slug) ? $product->slug : $parent->slug}}"
                        class="text-base font-medium text-gray-900 hover:underline">
                        @if(isset($parent))
                            <p>{{ $parent->name }}</p>
                            <span class="text-sm text-gray-500">{{ $product->name }}</span>
                        @else
                            <p>
                                {{ $product->name }}
                            </p>
                        @endif
                    </a>
                    <p class="text-base text-gray-900 truncate">
                        @if(isset($parent))
                            {{ $parent->slogan }}
                        @else
                            {{ $product->slogan }}
                        @endif

                    </p>
                </div>
            </div>

            <hr class="col-span-3" md:hidden>

            <div class="flex col-span-2 justify-around md:order-4 md:grid">
                <div class="flex items-center justify-between md:justify-center ">
                    @livewire('buttons.increment-decrement-cart', ['product' => $product])
                </div>

                <div class="flex items-center gap-4">
                    @livewire('buttons.remove-from-cart', ['product' => $product])
                </div>
            </div>

            <div class="text-center self-center md:order-3 md:w-32">
                @if (!is_null($product->price_with_discount))
                    <p class="text-base font-bold text-primary-700 line-through">
                        {{ $cart->getTotalCostforProductWithoutDiscount($product, true) }}
                    </p>
                @endif
                <p class="text-base font-bold text-gray-900">{{ $cart->getTotalCostforProduct($product, true) }}</p>
            </div>

        </div>
    </div>
</div>
