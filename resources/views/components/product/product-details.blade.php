<div class="grid grid-cols-1 items-center my-2 xl:my-4">
    @if( count($variants) )
        <div>
            <label for="variants" class="mr-4">{{ __('Choose a variant') }}:</label>
            <select name="variants" id="product_variants" class="focus:border-inherit focus:outline-none focus:ring-inherit rounded-md">
                @foreach($variants as $variant)
                    <option value="{{ $variant->ean13 }}">{{$variant->ean13}}</option>
                @endforeach
            </select>
        </div>
        <br/>
    @endif

    <div class="my-2 xl:my-4">
        @if(count($variants))
            @if ($variant->first()->price_with_discount)
                <span class="text-md font-bold text-primary-500 mr-2">
                    {{ $variant->first()->price_with_discount }}€
                </span>
                <span class="text-gray-800 pr-2 line-through text-sm text-slate-600">
                    {{ $variant->first()->price }}€
                </span>
            @else
                <span class="text-md font-bold text-primary-500">
                    {{ $variant->first()->price }}€
                </span>
            @endif
        @else
            @if ($product->price_with_discount)
                <span class="text-md font-bold text-primary-500">
                    {{ $product->price_with_discount }}€
                </span>
                <span class="text-gray-800 pr-2 line-through text-sm text-slate-600">
                    {{ $product->price }}€
                </span>
            @else
                <span class="text-md font-bold text-primary-500">
                    {{ $product->price }}€
                </span>
            @endif
        @endif
    </div>

    <div class="col-span-2 justify-center items-center">
        @if( count($variants) )
            @livewire('product.product-buttons', ['product' => $variants->first()])
        @else
            @livewire('product.product-buttons', ['product' => $product])
        @endif
    </div>
</div>