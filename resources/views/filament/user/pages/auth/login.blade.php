<div class="mt-10 mx-10 max-w-md md:mx-auto">
    <x-filament-panels::page.simple>
        @if (filament()->hasRegistration())
            <x-slot name="subheading">
                {{ __('filament-panels::pages/auth/login.actions.register.before') }}

                {{ $this->registerAction }}
            </x-slot>
        @endif

        <x-filament-panels::form wire:submit="authenticate">
            {{ $this->form }}

            <x-filament-panels::form.actions :actions="$this->getCachedFormActions()" :full-width="$this->hasFullWidthFormActions()" />
        </x-filament-panels::form>

    </x-filament-panels::page.simple>

    <script>
        // Hide logo
        let logo = document.getElementsByClassName("fi-logo")[0];
        logo.remove();
    </script>
</div>
