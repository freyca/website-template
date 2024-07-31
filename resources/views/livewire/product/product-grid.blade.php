<div class="container mx-auto py-8">
    @if (method_exists($products, 'links'))
        {{ $products->links() }}
    @endif

    <div class="mt-4 grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-4 gap-4">
        @foreach ($products as $product)
            <x-product.product-card :product="$product" />
        @endforeach
    </div>
</div>
