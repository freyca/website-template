<x-layouts.app title="{{ config('custom.title') }}" metaDescription="{{ $product->meta_description }}">
    @inject(cart, '\App\Services\Cart')

    <div class="mx-6">
        <h1 class="text-3xl font-bold mb-4">{{ $product->name }}</h1>
        <h2 class="mb-4">{{ $product->slogan }}</h2>

        <div class="grid gap-4 md:gap-14 lg:grid-cols-1 xl:grid-cols-2">
            <x-product.product-image-gallery :product="$product" />

            <div class="text-gray-700 text-justify">
                <div class="mb-4">
                    {!! $product->short_description !!}
                </div>

                @if (!isset($variants))
                    @php $variants = collect(); @endphp
                @endif

                <x-product.product-details :product="$product" :variants="$variants" />

                <div class="text-gray-700 text-justify grid gap-2 pt-4">
                    <p>@svg('heroicon-m-home', 'w-6 h-6 inline-block text-primary-600') Recibirás en casa el producto {{strtolower($product->name)}}</p>
                    <p>@svg('heroicon-s-user-group', 'w-6 h-6 inline-block text-primary-600') Máquinas probadas de forma exhaustiva por nuestros técnicos: conocemos cada detalle de las máquinas que comercializamos. Esto nos permite ofrecer productos confiables y resolver incidencias de forma efectiva.</p>
                    <p>@svg('heroicon-m-cog-8-tooth', 'w-6 h-6 inline-block text-primary-600') 3 años de garantía oficial Roteco</p>
                    <p>@svg('heroicon-m-wrench', 'w-6 h-6 inline-block text-primary-600') Servicio de recambios y SAT</p>
                </div>
            </div>
        </div>

        <div class="container mx-auto mt-4 mb-10">
            @if (isset($featureValues) && !is_null($featureValues) && count($featureValues) > 0)
                @livewire('product.product-feature-container', ['features' => $features, 'featureValues' => $featureValues])
            @endif

            <div class="text-gray-700 text-justify">
                {!! $product->description !!}
            </div>
        </div>

        @if (!isset($featuredProducts))
            @php $featuredProducts = collect(); @endphp
        @endif
        <x-sliders.featured-products :featuredProducts="$featuredProducts" />
    </div>
</x-layouts.app>
