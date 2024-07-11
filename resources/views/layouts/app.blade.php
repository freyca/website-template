<!DOCTYPE html>
<html lang="es">

<x-head.head :title="$attributes['title']" :metaDescription="$attributes['metaDescription']" />

<body class="bg-gray-100 text-gray-900">
    <x-navbar.navbar />

    <div class="container mx-auto mt-4 p-4">
        {{ $slot }}
    </div>

    <x-footer.footer />

    @vite('resources/js/app.js')
    @livewire('notifications')
    @filamentScripts
</body>

</html>
