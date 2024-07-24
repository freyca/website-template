@php
    $path = match (true) {
        get_class($product) === 'App\Models\ProductSparePart' => '/pieza-de-repuesto',
        get_class($product) === 'App\Models\ProductComplement' => '/complemento',
        default => '/producto',
    };
@endphp

<div class="bg-white shadow-lg rounded-lg overflow-hidden group transition-shadow duration-300 hover:shadow-xl">
    <div class="relative pb-48 overflow-hidden">
        <img class="absolute inset-0 h-full w-full object-cover" src="{{ @asset('../images/' . rand(1,75) . '.png') }}" alt="{{ $product->name }}">
        <div class="absolute inset-0 bg-blue-950 bg-opacity-60 grid items-center justify-center text-center opacity-0 group-hover:opacity-100 transition duration-300">

            <div class="mx-auto text-center">
                <p class="text-white opacity-90 mx-4 mb-4 dark:text-white-400">{{ Str::limit($product->description, 60) }}</p>
                 
                <button 
                class="inline details-btn hover:underline items-center  ">
                <span class="flex items-center text-lg font-bold text-primary bg-opacity-85 ">
                    @svg('heroicon-o-information-circle','w-7 h-7') 
                    {{ __('Detalles') }} 
                </span>
                  </button>

            </div>
        </div>
    </div>
    <div class="p-4 mb-1 items-center">
        <h3 class="text-xl font-semibold mb-2">{{ $product->name }}</h3>
        <div class="flex items-center justify-between">
            <div class="mx-auto">
                
                <span class="text-md font-bold text-primary-500">
                    {{ $product->price }} €
                </span>
            </div>
            
            @livewire('buttons.add-to-cart', ['product' => $product])
        </div>
    </div>
</div>