<!DOCTYPE html>
<html lang="es">

<head>
    @include('partials.head')
</head>

<body class="bg-gray-100">

    <x-navbar.navbar />

    <x-main-content-area />

    <x-footer.footer />

    @vite('resources/js/app.js')
</body>

</html>
