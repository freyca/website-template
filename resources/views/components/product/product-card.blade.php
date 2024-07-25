@php
    $path = match (true) {
        get_class($product) === 'App\Models\ProductSparePart' => '/pieza-de-repuesto',
        get_class($product) === 'App\Models\ProductComplement' => '/complemento',
        default => '/producto',
    };
@endphp

<div class="bg-white shadow-lg rounded-lg overflow-hidden group transition-shadow duration-300 hover:shadow-2xl flex flex-col justify-between h-full">
    <div class="relative pb-48 overflow-hidden">
        <img class="absolute inset-0 h-full w-full object-cover transition-transform duration-300 transform group-hover:scale-110" src="{{ @asset('../images/' . rand(1,75) . '.png') }}" alt="{{ $product->name }}">
        <div class="absolute inset-0 bg-gradient-to-b from-blue-950 to-transparent bg-opacity-70 flex items-center justify-center text-center opacity-0 group-hover:opacity-100 transition duration-300">
            <a href="{{ $path . '/' . $product->slug }}">
                <div class="mx-auto text-center">
                    <p class="text-white opacity-90 mx-4 mb-4 text-sm sm:text-base">{{ Str::limit($product->description, 60) }}</p>
                    <button  class="inline-flex items-center px-4 py-2 border border-transparent text-sm sm:text-base font-medium rounded-md shadow-sm text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition duration-300">
                        @svg('heroicon-o-information-circle','w-6 h-6 mr-2') 
                        {{ __('Detalles') }}
                    </button>
                </div>
            </a>
        </div>
    </div>
    <div class="p-4 flex-grow flex flex-col justify-between">
        <h3 class="text-xl font-semibold mb-2 text-gray-800">{{ $product->name }}</h3>
        <div class="flex items-center justify-between mt-auto space-x-2">
            <div class="text-lg font-bold text-green-600 flex-shrink-0 whitespace-nowrap">
                {{ number_format($product->price, 2, ',', '.') }} €
            </div>
            @livewire('buttons.add-to-cart', ['product' => $product])
        </div>
    </div>
</div>
