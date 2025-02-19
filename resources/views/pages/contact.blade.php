<x-layouts.app title="{{ config('custom.title') }}" metaDescription="Metadescripcion de la pagina de contacto">

    <x-bread-crumbs  :breadcrumbs="
        [
            __('Contact us') => route('contact'),
        ]"
    />

    <div class="mx-4">
        @livewire('forms.contact-form')

        <x-location-map />
    </div>

    <x-buttons.whats-app-button />
</x-layouts.app>
