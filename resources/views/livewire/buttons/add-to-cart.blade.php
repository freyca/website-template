<button wire:click="add" type="submit"
    class="inline shadow bg-white border-2 border-primary-800 text-primary-100 text-sm hover:bg-primary-200 p-2 px-4 rounded">

    <span class="flex items-center whitespace-nowrap text-primary-800 font-semibold text-md">
        @svg('heroicon-o-shopping-bag', 'w-5 h-5') &nbsp; {{ __('Add to cart') }}
    </span>
</button>
