<button wire:click="add" type="submit"
    class="inline shadow bg-primary-500 text-gray-100 text-sm hover:bg-primary-700 active:translate-x-1 active:translate-y-1 py-2 px-4 rounded">

    <span class="flex items-center whitespace-nowrap">
        @svg('heroicon-o-shopping-bag', 'w-5 h-5') &nbsp; {{ __('Add to cart') }} </span>
    </span>
</button>
