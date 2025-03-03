<div class="container mx-auto py-2">
    <div class="grid grid-cols-2 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-3 md:gap-6">
        @foreach ($products as $product)
            <x-product.product-card :product="$product" />
        @endforeach
    </div>
</div>
