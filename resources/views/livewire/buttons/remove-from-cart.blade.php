<button wire:click="remove" type="submit"
    class="inline shadow bg-white border-2 border-gray-400 text-black text-sm py-2 px-4 rounded hover:bg-gray-300 active:translate-x-1 active:translate-y-1">
    <span class="flex items-center">
        @svg('heroicon-s-trash', 'h-4 w-4') &nbsp; {{ __('Remove') }}
    </span>
</button>
