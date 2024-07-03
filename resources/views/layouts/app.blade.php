<!DOCTYPE html>
<html lang="es">

<head>
    @include('partials.head')
</head>

<body class="bg-gray-100 text-gray-900">

    <x-navbar.navbar />

    <div class="container mx-auto mt-8">
        @yield('main-content')
    </div>

    <x-footer.footer />

    @vite('resources/js/app.js')
</body>

</html>
