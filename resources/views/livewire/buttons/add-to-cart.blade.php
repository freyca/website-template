<button wire:click="add" type="submit"
    class="inline shadow bg-green-300 text-black hover:bg-green-400 active:translate-x-1 active:translate-y-1 py-2 px-4 rounded">
    <span class="flex items-center">
        @svg('heroicon-o-shopping-bag', 'w-5 h-5') &nbsp; 
        <span class="hidden sm:inline">&nbsp; {{ __('Add to cart') }}</span>
    </span>
</button>
