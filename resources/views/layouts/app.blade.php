<!DOCTYPE html>
<html lang="es">

<head>
    @include('partials.head')
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    

    <!-- Tailwind CSS -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>

<body class="bg-gray-100">

    @include('partials.navbar')
    @include('partials.brand-bar')
    <!-- Hero Section -->
    <div class="container mt-5" style="margin-top: 100px;">
        <div class="row">
            <div class="col-md-8">
                <h1 class="text-4xl font-bold text-gray-800">Bienvenido a Mi Sitio Web</h1>
                <p class="mt-4 text-lg text-gray-600">Este es un sitio web de ejemplo usando Bootstrap y Tailwind.</p>
            </div>
            <div class="col-md-4">
                <div class="p-4 bg-white shadow-lg rounded-lg">
                    <form class="d-flex" role="search">
                        <input class="form-control me-2" type="search" placeholder="¿Qué necesitas?" aria-label="Buscar">
                        <button class="btn btn-outline-success" type="submit">Buscar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content Area -->
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="container mt-5">
                    @yield('main-content')
                </div>
            </div>
        </div>

        <!-- Main Slider -->
        <div class="row mt-5">
            <div class="col-12">
                <div class="p-5 bg-primary text-white text-center rounded-lg">
                    <h1>Saludos :D</h1>
                </div>
            </div>
        </div>
    </div>

    @include('partials.footer')

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

    @vite('resources/js/app.js')
</body>

</html>
