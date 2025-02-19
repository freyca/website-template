<x-layouts.app title="{{ config('custom.title') }}" metaDescription="{{ $category->meta_description }}">
    <div class="container mx-auto rounded-md">

        <x-bread-crumbs  :breadcrumbs="
            [
                __('Categories') => route('category-list'),
                __($category->name) => $category->slug,
            ]"
        />

        <div class="grid grid-cols-1 mt-4 lg:gap-4 lg:grid-cols-3 mb-4">
            <div class="grid place-content-center flex bg-primary-800 rounded mx-4">
                <figure class="p-6">
                    <picture>
                        <img class="h-56" src="{{ @asset('/storage/' . $category->big_image) }}">
                    </picture>
                </figure>
            </div>

            <div class="grid place-content-center col-span-2 m-4">
                <div class="align-middle">
                    <h1 class="text-3xl font-bold my-4">
                        {{ $category->name }}
                    </h1>

                    <hr />

                    <p class="text-justify mt-4">
                        {!! $category->description !!}
                    </p>
                </div>
            </div>
        </div>

        <x-product-grid :products="$products" />
    </div>

    <x-buttons.whats-app-button />
</x-layouts.app>
