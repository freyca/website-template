<div class="basis-1/3 my-10">
    @php
        $path = match (true) {
            get_class($product) === 'App\Models\ProductSparePart' => '/pieza-de-repuesto',
            get_class($product) === 'App\Models\ProductComplement' => '/complemento',
            default => '/producto',
        };
    @endphp

    <a href="{{ $path }}/{{ $product->slug }}">
        <img class="mx-auto justify-center h-52" src="{{ @asset('/storage/' . $product->main_image) }}" />
        <h2 class="mx-auto mt-2 text-center text-2xl font-bold"> {{ $product->name }} </h2>
    </a>
    <p class="mx-auto mt-2 text-center">{{ $product->slogan }}</p>
</div>
