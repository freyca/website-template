<div class="container mx-auto py-8">
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-4 gap-4">
        @foreach ($products as $product)
            <x-product.product-card :product="$product" />
        @endforeach
    </div>
    
  
    <div class="fixed float-left top-10 text-gray-700 font-semibold" style="
    top: 145px;
    right: 109px;
    "><span class="font-semibold">{{ __('Number of results:') }} {{ $filteredResultsCount }}</span> 
    </div>
</div>