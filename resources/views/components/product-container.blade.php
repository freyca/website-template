<div class="w-full max-w-xs" style="border: 4px solid black">
    @php
        $path = match (true) {
            get_class($product) === 'App\Models\ProductSparePart' => '/pieza-de-repuesto',
            get_class($product) === 'App\Models\ProductComplement' => '/complemento',
            default => '/producto',
        };
    @endphp

    <a href="{{ $path }}/{{ $product->slug }}">
        <img src="{{ @asset('/storage/' . $product->main_image) }}" style="max-height: 200px" />
        <h2 class="text-2xl font-bold"> {{ $product->name }} </h2>
    </a>
    <p>{{ $product->slogan }}</p>
</div>
