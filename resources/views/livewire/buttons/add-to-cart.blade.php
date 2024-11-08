<button wire:click="add" type="submit"
    class="inline shadow bg-white border-2 border-primary-400 text-gray-100 text-sm hover:bg-primary-200 active:translate-x-1 active:translate-y-1 py-2 px-4 rounded">

    <span class="flex items-center whitespace-nowrap text-black">
        @svg('heroicon-o-shopping-bag', 'w-5 h-5') &nbsp; {{ __('Add to cart') }} </span>
    </span>
</button>
