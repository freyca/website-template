

<button wire:click="add" type="submit"
class="shadow bg-green-300 text-black hover:bg-green-400 active:translate-x-1 active:translate-y-1 py-2 px-4 rounded inline-flex items-center border border-transparent text-sm sm:text-base font-medium transition duration-300">
 
    <span class="flex items-center whitespace-nowrap">
        @svg('heroicon-o-shopping-bag', 'w-5 h-5') &nbsp; 
        <span class=" hidden xl:block transition-transform duration-500 ease-in-out">{{ __('Add to cart') }}</span>
    </span>
</button>