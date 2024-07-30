<!DOCTYPE html>
<html lang="es">

<x-head.head :title="$title" :metaDescription="$metaDescription" />

<body id="app-container" class="bg-gray-100 text-gray-900 min-h-screen m-0 flex flex-col">
    <x-navbar.navbar />

    <div class="relative min-h-screen">
        <div class="container mx-auto mt-4 sm:p-4">
            {{ $slot }}
        </div>

        @if (preg_match('/\-list$/', Route::current()->getName()))
            <x-buttons.filter-button />
            @livewire('aside.filter', key(md5('aside.filter')))
        @endif
    </div>

    <x-footer.footer />

    @vite('resources/js/app.js')
    @livewire('notifications')
    @filamentScripts
</body>

</html>
