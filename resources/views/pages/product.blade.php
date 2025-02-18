<x-layouts.app title="{{ config('custom.title') }}" metaDescription="{{ $product->meta_description }}">
    @inject(cart, '\App\Services\Cart')

    <div class="mx-6">
        <h1 class="text-3xl font-bold mb-4">{{ $product->name }}</h1>
        <h2 class="mb-4">{{ $product->slogan }}</h2>

        <div class="grid gap-4 md:gap-14 lg:grid-cols-1 xl:grid-cols-2">
            <x-product.product-image-gallery :product="$product" />

            <div class="text-gray-700 text-justify">
                <div id="product-short-description" class="mb-4">
                    {!! $product->short_description !!}
                </div>

                @if (!isset($variants))
                    @php $variants = collect(); @endphp
                @endif

                @livewire('buttons.product-cart-buttons', ['product' => $product, 'variants' => $variants])

                <x-product.payment-banners />
            </div>
        </div>

        <div class="container mx-auto mt-4 mb-20">
            @if (isset($featureValues) && !is_null($featureValues) && count($featureValues) > 0)
                @livewire('product.product-feature-container', ['features' => $features, 'featureValues' => $featureValues])
            @endif

            <div class="flex justify-center items-center">
                <h3 class="text-center mt-14 mb-10 bg-gray-800 p-4 rounded-full max-w-2xl">
                    <span class="font-bold text-lg text-gray-100">
                        {{ mb_strtoupper( __('Extended description of') . ' ' . $product->name) }}
                    </span>
                </h3>
            </div>
            <div class="text-gray-700 text-justify">
                {!! $product->description !!}
            </div>
        </div>

        @if (!isset($featuredProducts))
            @php $featuredProducts = collect(); @endphp
        @endif
        <x-sliders.featured-products :featuredProducts="$featuredProducts" />
    </div>

    <x-buttons.whats-app-button />
</x-layouts.app>
