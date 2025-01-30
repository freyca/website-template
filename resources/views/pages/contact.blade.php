<x-layouts.app title="{{ config('custom.title') }}" metaDescription="Metadescripcion de la pagina de contacto">

    <div class="mx-10">
        @livewire('forms.contact-form')

        <x-location-map />
    </div>

    <x-buttons.whats-app-button />
</x-layouts.app>
