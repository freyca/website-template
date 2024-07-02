@php
    $path = match (true) {
        get_class($product) === 'App\Models\ProductSparePart' => '/pieza-de-repuesto',
        get_class($product) === 'App\Models\ProductComplement' => '/complemento',
        default => '/producto',
    };
@endphp

<div class="bg-white shadow-md rounded-lg overflow-hidden">
    <a href="{{ $path }}/{{ $product->slug }}">
        <img src="{{ @asset('/storage/' . $product->main_image) }}" alt="Producto 1" class="w-full h-48 object-cover">
    </a>
        <div class="p-4">
            <a href="{{ $path }}/{{ $product->slug }}">
                <h2 class="text-xl font-bold mb-2">
                    {{ $product->name }}
                </h2>
            </a>

            <p class="text-gray-700">
                {{ $product->slogan }}
            </p>
            <div class="mt-4 flex justify-between items-center">
                @if($product->price_with_discount)
                <div>
                    <span class="text-xl font-bold text-red-500 pr-2">
                        <span class="line-through">
                            {{ $product->price }}
                        </span>
                        <span>
                            €
                        </span>
                    </span>
                    <span class="text-xl font-bold text-green-500">
                        {{ $product->price_with_discount }} €
                    </span>
                </div>
                @else
                <span class="text-xl font-bold text-green-500">
                    {{ $product->price }} €
                </span>
                @endif
                @livewire('buttons.add-to-cart', ['product' => $product])
            </div>
        </div>
</div>
