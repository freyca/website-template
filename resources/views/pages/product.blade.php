<x-layouts.app title="{{ config('custom.title') }}" metaDescription="{{ $product->meta_description }}">
    @inject(cart, '\App\Services\Cart')

    <div class="mx-6">
        <h1 class="text-3xl font-bold mb-4">{{ $product->name }}</h1>
        <h2 class="mb-4">{{ $product->slogan }}</h2>

        <div class="grid gap-20 lg:grid-cols-1 xl:grid-cols-2">
            <x-product.product-image-gallery :product="$product" />

            <div class="text-gray-700 text-justify">
                {!! $product->description !!}

                <div class="grid grid-cols-1 items-center my-2 xl:my-4">
                    <div class="my-2 xl:my-4">
                        @if ($product->price_with_discount)
                            <span class="text-md font-bold text-primary-500">
                                {{ $product->price_with_discount }}€
                            </span>
                            <span class="text-gray-800 text-xs pr-2 line-through">
                                {{ $product->price }}€
                            </span>
                        @else
                            <span class="text-md font-bold text-primary-500">
                                {{ $product->price }}€
                            </span>
                        @endif
                    </div>

                    <div class="col-span-2 justify-center items-center">
                        @livewire('product.product-buttons', ['product' => $product])
                    </div>
                </div>
            </div>
        </div>

        <div class="container mx-auto my-4">
            @if (isset($featureValues) && !is_null($featureValues) && count($featureValues) > 0)
                <x-product.product-feature-container :features="$features" :featureValues="$featureValues" />
            @endif
        </div>

        @php
            $products = \App\Models\Product::all()->take(5);
        @endphp

        <x-sliders.featured-products :products="$products" />
    </div>
</x-layouts.app>
