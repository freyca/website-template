@php
    $path = match (true) {
        get_class($product) === 'App\Models\ProductSparePart' => '/pieza-de-repuesto',
        get_class($product) === 'App\Models\ProductComplement' => '/complemento',
        default => '/producto',
    };
@endphp

<div
    class="bg-white shadow-lg rounded-lg overflow-hidden group transition-shadow duration-300 hover:shadow-2xl flex flex-col justify-between h-full">
    <a href="{{ $path . '/' . $product->slug }}">
        <div class="relative pb-48 overflow-hidden">
            <img class="absolute inset-0 h-full w-full object-scale-down transition-transform duration-300 transform group-hover:scale-110"
                src="{{ @asset('/storage/' . $product->main_image) }}" alt="{{ $product->name }}">
            <div
                class="absolute inset-0 bg-gradient-to-b from-slate-400 to-transparent bg-opacity-70 flex items-center justify-center text-center opacity-0 group-hover:opacity-100 transition duration-300">
                    <div class="mx-auto text-center">
                        <p class="text-white bg-black rounded-md py-2 opacity-80 m-4 text-sm sm:text-base">
                            {{ Str::limit($product->slogan, 60) }}
                        </p>
                    </div>
            </div>
        </div>
        <div class="p-4 flex-grow flex flex-col justify-between">
            <h3 class="text-xl font-semibold mb-2 text-gray-800">
                {{ $product->name }}
            </h3>
            <div class="flex items-center justify-between mt-auto space-x-2 overflow-hidden">
                @if ($product->price_with_discount)
                    <span class="text-md font-bold text-primary-500">
                        {{ $product->price_with_discount }}€
                    </span>
                    <span class="text-gray-800 text-md pr-2 line-through">
                        {{ $product->price }}€
                    </span>
                @else
                    <span class="text-md font-bold text-primary-500">
                        {{ $product->price }}€
                    </span>
                @endif
                {{-- @livewire('buttons.add-to-cart', ['product' => $product]) --}}
            </div>
        </div>
    </a>
</div>
