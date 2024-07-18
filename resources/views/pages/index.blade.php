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

        <x-product-grid :products="$products" />
    </div>
</x-layouts.app>
