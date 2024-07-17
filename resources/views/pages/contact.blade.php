<x-layouts.app title="{{ config('custom.title') }}" metaDescription="Metadescripcion de la pagina de contacto">
    @livewire('forms.contact-form')

    <x-location-map />
</x-layouts.app>
