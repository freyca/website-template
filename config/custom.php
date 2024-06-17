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
        'productos' => '/productos',
        'complementos de producto' => '/complementos-producto',
        'piezas de repuesto' => '/piezas-de-repuesto',
        'contacto' => '/contacto',
        'sobre Nosotros' => '/sobre-nosotros',
    ],

    /**
     * Categories to show in the main page after banner
     */
    'featured-categories' => [
        1,
        5,
        2,
    ],

    /**
     * Products to show in the main page
     * If the array is empty, it will 15 products Products table
     * TODO: criteria to show products
     */
    'featured-products' => [
        3,
        4,
        5,
        6,
        7,
    ],

    /**
     * Directory to save product images
     */
    'product-image-storage' => public_path('/storage/product-images'),

    /**
     * Directory to save category images
     */
    'category-image-storage' => public_path('/storage/category-images'),

];
