<x-layouts.app :title="config('custom.title')" :metaDescription="'Metadescripcion de la pagina de inicio'">
    <x-sliders.main-slider />

    <hr class="sm:mt-10 w-100" />

    <div class="container mx-auto">
        <h2 class="flex text-3xl font-bold mt-10 mx-auto justify-center">
            {{ __('Categories') }}
        </h2>

        <x-category-grid :categories="$categories" />
    </div>

    <hr class="sm:mt-10 w-100" />

    <div class="container mx-auto">
        <h2 class="flex text-3xl font-bold mt-10 mx-auto justify-center">
            {{ __('Products') }}
        </h2>

        <div class="container mx-auto py-8">
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 lg:grid-cols-4 xl:grid-cols-5 gap-3">
                @foreach ($products as $product)
                    <x-product.product-card :product="$product" />
                @endforeach
            </div>
        </div>

    </div>
</x-layouts.app>
