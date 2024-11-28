<div>
    @if ($variant->price_with_discount)
        <span class="text-md font-bold text-primary-500 mr-2">
            {{ $variant->price_with_discount }}€
        </span>
        <span class="text-gray-800 pr-2 line-through text-sm text-slate-600">
            {{ $variant->price }}€
        </span>
    @else
        <span class="text-md font-bold text-primary-500">
            {{ $variant->price }}€
        </span>
    @endif
</div>