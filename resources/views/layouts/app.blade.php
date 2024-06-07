<!DOCTYPE html>
<html lang="es">

<head>
    @include('layouts.head')
</head>

<body>
    @include('layouts.navbar')

    <div>
        @yield('main-content')
    </div>

    @include('layouts.footer')
</body>

</html>