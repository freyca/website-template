@php
    $path = match (true) {
        get_class($product) === 'App\Models\ProductSparePart' => '/pieza-de-repuesto',
        get_class($product) === 'App\Models\ProductComplement' => '/complemento',
        default => '/producto',
    };
@endphp

<div class="shadow-sm overflow-hidden hover:scale-105 transition-transform bg-white">
    <a href="{{ $path }}/{{ $product->slug }}">
        <img src="{{ @asset('/storage/' . $product->main_image) }}" alt="{{ $product->name }}"
            class="w-full object-scale-down bg-slate-900 border-4">

        <div class="px-1 pb-2 grid mt-2 bottom-2 right-0 left-0 mx-auto">
            <div class="mb-1">
                <h2 class="text-lg mb-2 text-center text-gray-800">
                    {{ $product->name }}
                </h2>

                <p class="text-gray-700 text-center text-sm">
                    {{ $product->slogan }}
                </p>
            </div>

            <div class="grid justify-items-center mb-1">
                <div class="mb-1 items-center">
                    @if ($product->price_with_discount)
                        <span class="text-gray-800 text-xs pr-2 line-through">
                            {{ $product->price }}€
                        </span>
                        <span class="text-md font-bold text-primary-500">
                            {{ $product->price_with_discount }}€
                        </span>
                    @else
                        <span class="text-md font-bold text-primary-500">
                            {{ $product->price }}€
                        </span>
                    @endif
                </div>
            </div>
        </div>
    </a>
</div>
