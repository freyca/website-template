<div class="container mx-auto py-8">
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 lg:grid-cols-4 xl:grid-cols-5 gap-3">
        @foreach ($products as $product)
            <x-product.product-card :product="$product" />
        @endforeach
    </div>
</div>
