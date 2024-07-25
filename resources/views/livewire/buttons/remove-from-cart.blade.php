<button wire:click="remove" type="submit"
    class="inline shadow bg-primary-400 hover:bg-primary-300 active:translate-x-1 active:translate-y-1 text-white font-bold py-2 px-4 rounded">
    <span class="flex items-center">
        @svg('heroicon-s-trash', 'h-4 w-4') &nbsp; {{ __('Remove') }}
    </span>
</button>
