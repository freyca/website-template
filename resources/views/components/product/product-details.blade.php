<div class="grid grid-cols-1 items-center my-2 xl:my-4">
    @if( count($variants) )
        <label for="variants">{{ __('Choose a variant:') }}</label>
        <br/>
        <select name="variants" id="product_variants">
            @foreach($variants as $variant)
                <option value="{{ $variant->ean13 }}">{{$variant->ean13}}</option>
            @endforeach
        </select>
        <br/>
    @endif

    <div class="my-2 xl:my-4">
        @if(count($variants))
            @if ($variant->first()->price_with_discount)
                <span class="text-md font-bold text-primary-500">
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