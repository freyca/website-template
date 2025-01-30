<button wire:click="remove" type="submit"
    class="inline shadow bg-gray-200 border-1 border-gray-400 text-black text-sm py-2 px-4 rounded hover:bg-gray-300">
    <span class="flex items-center">
        @svg('heroicon-s-trash', 'h-4 w-4') &nbsp; {{ __('Remove') }}
    </span>
</button>
