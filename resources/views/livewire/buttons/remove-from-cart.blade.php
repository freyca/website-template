<button wire:click="remove" type="submit"
    class="inline shadow bg-primary-100 border-2 border-primary-800 text-primary-800 text-sm py-2 px-4 rounded hover:bg-primary-300">
    <span class="flex items-center">
        @svg('heroicon-s-trash', 'h-4 w-4') &nbsp; {{ __('Remove') }}
    </span>
</button>
