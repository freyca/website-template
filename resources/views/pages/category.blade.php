<x-layouts.app title="{{ config('custom.title') }}" metaDescription="{{ $category->meta_description }}">
    <div class="container mx-auto p-4">

        <div class="grid grid-cols-1 my-4 gap-4 lg:grid-cols-2">
            <img class="rounded-lg items-center" src="{{ @asset('/storage/' . $category->big_image) }}">

            <div class="flex flex-col content-center">
                <h1 class="text-3xl font-bold mb-4">
                    {{ $category->name }}
                </h1>

                <hr />

                <p class="text-justify mt-4">
                    {!! $category->description !!}
                </p>
            </div>
        </div>

        <hr />

        <x-product-grid :products="$products" />
    </div>
</x-layouts.app>
