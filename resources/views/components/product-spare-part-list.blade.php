<div>
    <ul>
    @foreach ($relatedSpareparts as $spare_part)
        <li class="p-1 grid grid-cols-2 my-1">
            <div class="flex items-center">⚙️ - {{ $spare_part->name }}</div>
            @livewire('buttons.product-cart-buttons', ['product' => $spare_part, collect() ])
        </li>
    @endforeach
    </ul>
</div>