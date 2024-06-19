<!DOCTYPE html>
<html lang="es">

<head>
    @include('partials.head')
</head>

<body>
    @include('partials.navbar')

    <div>
        @yield('main-content')
    </div>

    @include('partials.footer')

    @vite('resources/js/app.js')
</body>

</html>