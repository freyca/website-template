<x-layouts.app title="{{ config('custom.title') }}" metaDescription="{{ $product->meta_description }}">
    @inject(cart, '\App\Services\Cart')

    <div class="mx-6">
        <h1 class="text-3xl font-bold mb-4">{{ $product->name }}</h1>
        <h2 class="mb-4">{{ $product->slogan }}</h2>

        <div class="grid gap-5 lg:grid-cols-1 xl:grid-cols-2">
            <x-product.product-image-gallery :product="$product" />

            <div class="text-gray-700 text-justify">
                <div class="mb-4">
                    {!! $product->short_description !!}
                </div>

                {!! $product->description !!}

                @if (!isset($variants))
                    @php $variants = collect(); @endphp
                @endif
                <x-product.product-details :product="$product" :variants="$variants" />

            </div>
        </div>

        <div class="container mx-auto my-4">
            @if (isset($featureValues) && !is_null($featureValues) && count($featureValues) > 0)
                @livewire('product.product-feature-container', ['features' => $features, 'featureValues' => $featureValues])
            @endif
        </div>

        @if (!isset($featuredProducts))
            @php $featuredProducts = collect(); @endphp
        @endif
        <x-sliders.featured-products :featuredProducts="$featuredProducts" />
    </div>
</x-layouts.app>
