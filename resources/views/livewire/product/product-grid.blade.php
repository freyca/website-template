<div class="container mx-auto py-8">
    @if (method_exists($products, 'links'))
        {{ $products->links() }}
    @endif

    <x-product-grid :products="$products" />
</div>
