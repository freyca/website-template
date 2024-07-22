<x-layouts.app title="{{ config('custom.title') }}" metaDescription="{{ $category->meta_description }}">
    <div class="container mx-auto p-4 bg-gray-200 rounded-md">

        <div class="grid grid-cols-1 my-4 lg:gap-4 lg:grid-cols-3">
            <div class="grid place-content-center">
                <img class="rounded-lg items-center max-h-96" src="{{ @asset('/storage/' . $category->big_image) }}">
            </div>

            <div class="grid place-content-center col-span-2">
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

        <hr />

        <x-product-grid :products="$products" />
    </div>
</x-layouts.app>
