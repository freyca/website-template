@php
    $path = match (true) {
        get_class($product) === 'App\Models\ProductSparePart' => '/pieza-de-repuesto',
        get_class($product) === 'App\Models\ProductComplement' => '/complemento',
        default => '/producto',
    };
@endphp

<div class="shadow-md rounded-lg overflow-hidden mx-5 hover:scale-105 transition-transform duration-300">
    <a href="{{ $path }}/{{ $product->slug }}">
        <img src="{{ @asset('/storage/' . $product->main_image) }}" alt="Producto 1" class="w-full h-48 object-cover">
    </a>

    <div class="p-4 flex flex-col bg-gray-500 h-full">
        <div class="mb-4">
            <a href="{{ $path }}/{{ $product->slug }}">
                <h2 class="text-xl font-bold mb-2">
                    {{ $product->name }}
                </h2>
            </a>

            <p class="text-gray-700">
                {{ $product->slogan }}
            </p>
        </div>

        <div class="flex justify-between items-center">
            <div>
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
            @livewire('buttons.add-to-cart', ['product' => $product])
        </div>
    </div>
</div>
