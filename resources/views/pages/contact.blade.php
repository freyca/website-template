<x-layouts.app title="{{ config('custom.title') }}" metaDescription="Metadescripcion de la pagina de contacto">

    @php
        $breadcrumbs = new App\Factories\BreadCrumbs\StandardPageBreadCrumbs([
            __('Contact us') => route('contact'),
        ]);
    @endphp

    <x-bread-crumbs :breadcrumbs="$breadcrumbs" />

    <div class="mx-4">
        @livewire('forms.contact-form')

        <x-location-map />
    </div>

    <x-buttons.whats-app-button />
</x-layouts.app>
