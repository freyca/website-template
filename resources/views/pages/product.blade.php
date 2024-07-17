<x-layouts.app title="{{ config('custom.title') }}" metaDescription="{{ $product->meta_description }}">
    @inject(cart, '\App\Services\Cart')

    <h1 class="text-3xl font-bold mb-4">{{ $product->name }}</h1>
    <h2 class="mb-4">{{ $product->slogan }}</h2>

    <div class="grid gap-4 2xl:grid-cols-2">
        <x-product.product-image-gallery :product="$product" />

        <div class="text-gray-700 text-justify">
            {!! $product->description !!}
        </div>

        <div class="items-left my-4">
            <div class="mx-auto my-2">
                @if ($product->price_with_discount)
                    <span class="text-xl font-bold text-red-500 pr-2 line-through">
                        {{ $product->price }} €
                    </span>
                    <span class="text-xl font-bold text-green-500">
                        {{ $product->price_with_discount }} €
                    </span>
                @else
                    <span class="text-xl font-bold text-green-500">
                        {{ $product->price }} €
                    </span>
                @endif
            </div>

            <div class="mx-auto my-2">
                @livewire('product.product-buttons', ['product' => $product])
            </div>
        </div>
    </div>

    <div class="container mx-auto my-4">
        @if (isset($featureValues) && !is_null($featureValues) && count($featureValues) > 0)
            <x-product.product-feature-container :features="$features" :featureValues="$featureValues" />
        @endif
    </div>

    </div>

    @php
        $products = \App\Models\Product::all()->take(10);
    @endphp
    <x-sliders.featured-products :products="$products" />
</x-layouts.app>
