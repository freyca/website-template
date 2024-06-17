<?php

return [
    /**
     * Default website title
     */
    'title' => env('APP_NAME', 'Maquinaria Roteco'),

    /**
     * Sections which will be shown in the navigation bar
     */
    'nav-sections' => [
        'categorías' => '/categorias',
        'contacto' => '/contacto',
        'sobre Nosotros' => '/sobre-nosotros',
        'productos' => '/productos',
        'complementos de producto' => '/complementos-producto',
        'piezas de repuesto' => '/piezas-de-repuesto',
    ],

    /**
     * Categories to show in the main page after banner
     */
    'featured-categories' => [
        'cortacésped',
        'motosierras',
        'desbrozadoras',
    ],

    /**
     * Products to show in the main page
     * If the array is empty, it will 15 products Products table
     * TODO: criteria to show products
     */
    'featured-products' => [],

    /**
     * Directory to save product images
     */
    'product-image-storage' => public_path('/storage/product-images'),

    /**
     * Directory to save category images
     */
    'category-image-storage' => public_path('/storage/category-images'),

];
