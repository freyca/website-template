<div class="flex mx-auto">
    @if (!$inCart)
        @livewire('buttons.add-to-cart', ['product' => $product, 'assembly_status' => $this->getAssemblyStatus()])
    @else
        <div>
            @livewire('buttons.remove-from-cart', ['product' => $product, 'assembly_status' => $this->getAssemblyStatus()])
        </div>
        <div class="">
            @livewire('buttons.increment-decrement-cart', ['product' => $product, 'assembly_status' => $this->getAssemblyStatus()])
        </div>
    @endif
</div>