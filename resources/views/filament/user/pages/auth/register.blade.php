<div class="max-w-md mx-10 md:mx-auto mb-10">
    <x-filament-panels::page.simple>
        @if (filament()->hasLogin())
            <x-slot name="subheading">
                {{ __('filament-panels::pages/auth/register.actions.login.before') }}

                {{ $this->loginAction }}
            </x-slot>
        @endif

        {{ \Filament\Support\Facades\FilamentView::renderHook(\Filament\View\PanelsRenderHook::AUTH_REGISTER_FORM_BEFORE, scopes: $this->getRenderHookScopes()) }}

        <x-filament-panels::form wire:submit="register">
            {{ $this->form }}

            <x-filament-panels::form.actions :actions="$this->getCachedFormActions()" :full-width="$this->hasFullWidthFormActions()" />
        </x-filament-panels::form>

        {{ \Filament\Support\Facades\FilamentView::renderHook(\Filament\View\PanelsRenderHook::AUTH_REGISTER_FORM_AFTER, scopes: $this->getRenderHookScopes()) }}

        <x-filament-socialite::buttons />
    </x-filament-panels::page.simple>

    <script>
        // Delete logo
        let logo = document.getElementsByClassName("fi-logo")[0];
        logo.remove();
    </script>

</div>
