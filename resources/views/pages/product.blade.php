<x-layouts.app title="{{ config('custom.title') }}" metaDescription="{{ $product->meta_description }}">
    @inject(cart, '\App\Services\Cart')

    <div class="mx-6">
        <h1 class="text-3xl font-bold mb-4">{{ $product->name }}</h1>
        <h2 class="mb-4">{{ $product->slogan }}</h2>

        <div class="grid gap-20 lg:grid-cols-1 xl:grid-cols-2">
            <x-product.product-image-gallery :product="$product" />

            <div class="text-gray-700 text-justify">
                {!! $product->description !!}

                <x-product.product-details :product="$product" :variants="$variants" />
            </div>
        </div>

        <div class="container mx-auto my-4">
            @if (isset($featureValues) && !is_null($featureValues) && count($featureValues) > 0)
                @livewire('product.product-feature-container', ['features' => $features, 'featureValues' => $featureValues])
            @endif
        </div>

        <x-sliders.featured-products :featuredProducts="$featuredProducts" />
    </div>
</x-layouts.app>
