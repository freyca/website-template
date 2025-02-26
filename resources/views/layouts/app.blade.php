<!DOCTYPE html>
<html lang="es">

<x-head.head :metaDescription="$metaDescription" />

<body id="app-container" class="bg-white-100 text-primary-900 min-h-screen m-0">
    <x-navbar.navbar />

    <main class="relative container mx-auto mt-4 sm:p-4">
        {{ $slot }}
    </main>

    <x-footer.footer />

    @vite('resources/js/app.js')
    @livewire('notifications')
    @filamentScripts
</body>

</html>
