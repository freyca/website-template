<head>
    <title>{{ $title }}</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="{{ $metaDescription }}">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="icon" href="https://roteco.es/wp-content/uploads/2018/04/cropped-Favicon-castroteco-192x192.png"
        sizes="192x192">
    <link rel="icon" href="https://roteco.es/wp-content/uploads/2018/04/cropped-Favicon-castroteco-32x32.png"
        sizes="32x32">
    <link rel="apple-touch-icon"
        href="https://roteco.es/wp-content/uploads/2018/04/cropped-Favicon-castroteco-180x180.png">

    @vite('resources/css/app.css')
    @filamentStyles
</head>
