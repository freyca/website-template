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
</body>

</html>