@php
    $path = match (true) {
        get_class($product) === 'App\Models\ProductSparePart' => '/pieza-de-repuesto',
        get_class($product) === 'App\Models\ProductComplement' => '/complemento',
        default => '/producto',
    };
@endphp

<div class="shadow-md rounded-lg overflow-hidden mx-5 hover:scale-105 transition-transform duration-300 bg-gray-500">
    <a href="{{ $path }}/{{ $product->slug }}">
        <img src="{{ @asset('/storage/' . $product->main_image) }}" alt="{{ $product->name }}"
            class="w-full pt-6 h-48 object-contain">
    </a>

    <div class="p-4 grid justify-center">
        <div class="mb-4">
            <a href="{{ $path }}/{{ $product->slug }}">
                <h2 class="text-xl font-bold mb-2 text-center">
                    {{ $product->name }}
                </h2>
            </a>

            <p class="text-gray-700 text-center text-ellipsis">
                {{ $product->slogan }}
            </p>
        </div>

        <div class="grid justify-items-center">
            <div class="mb-4">
                @if ($product->price_with_discount)
                    <span class="text-primary-700 pr-2 line-through">
                        {{ $product->price }}€
                    </span>
                    <span class="text-xl font-bold text-green-800">
                        {{ $product->price_with_discount }}€
                    </span>
                @else
                    <span class="text-xl font-bold text-green-800">
                        {{ $product->price }}€
                    </span>
                @endif
            </div>
            {{-- @livewire('buttons.add-to-cart', ['product' => $product], key($product->id)) --}}
        </div>
    </div>
</div>
