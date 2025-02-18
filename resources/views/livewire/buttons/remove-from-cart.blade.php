<button wire:click="remove" type="submit"
    class="inline shadow bg-gray-100 border-2 border-gray-800 text-gray-800 text-sm py-2 px-4 rounded hover:bg-gray-300">
    <span class="flex items-center">
        @svg('heroicon-s-trash', 'h-4 w-4') &nbsp; {{ __('Remove') }}
    </span>
</button>
