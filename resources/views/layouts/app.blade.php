<!DOCTYPE html>
<html lang="es">

<x-head.head :title="$title" :metaDescription="$metaDescription" />

<body class="bg-gray-100 text-gray-900">

    <x-navbar.navbar />

    <div class="container mx-auto mt-4 p-4">
        @yield('main-content')
    </div>

    <x-footer.footer />

    @vite('resources/js/app.js')
</body>

</html>
