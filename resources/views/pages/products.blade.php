<x-layouts.app title="{{ config('custom.title') }}" metaDescription="Metadescripcion de la pagina de products">
    <x-product-grid :products="$products" />
</x-layouts.app>
