<x-layouts.app title="{{ config('custom.title') }}" metaDescription="Metadescripcion de la pagina de products">

    @php
        $breadcrumbs = new App\Factories\BreadCrumbs\StandardPageBreadCrumbs([
            __('Products') => route('product-list'),
        ]);
    @endphp

    <x-bread-crumbs :breadcrumbs="$breadcrumbs" />

    <div class="main-content transition-all duration-500 ease-in-out px-4 w-auto">
        @livewire('product.product-grid', key(md5('product.product-grid')), ['class_name' => \App\Models\Product::class])
    </div>

    @livewire('buttons.filter-button', key(md5('buttons.filter')))

    @livewire('aside.filter', key(md5('aside.filter')), ['filters' => ['price' => true, 'category' => true, 'features' => true]])

</x-layouts.app>
