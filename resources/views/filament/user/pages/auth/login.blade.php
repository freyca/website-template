<div class="mt-10 mx-10 max-w-md md:mx-auto">

    @if (session('email_account_exists'))
    <div class="mb-8 space-2 text-center">
        <p class="font-bold text-xl mb-1">{{ __('An account already exists with this email') }}</p>
        <p class="mb-1 text-lg font-semibold text-danger-500">{{ __('Please, login below before complete the purchase') }}</p>
        <p class="mb-1 text-md mb-2">{{ __('If you do not remember your password use the link to change it') }}</p>
        <hr class="border border-solid">
    </div>
    @endif

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

        @if(str_ends_with(url()->current(), '/user/login'))
            <x-filament-socialite::buttons />
        @endif

    </x-filament-panels::page.simple>

    <script>
        // Hide logo
        let logo = document.getElementsByClassName("fi-logo")[0];
        logo.remove();
    </script>
</div>
