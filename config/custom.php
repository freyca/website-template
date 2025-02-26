<?php

return [
    /**
     * Default website title
     */
    'title' => env('APP_NAME', 'Maquinaria Roteco'),

    /**
     * Sections which will be shown in the navigation bar
     *
     * This configuration is hardly coupled with tests/Datasets/ConfigUrls.php
     * If any url is added, removed or modified here it should be in done in
     * correspondant dataset
     */
    'nav-sections' => [
        'productos' => '/productos',
        'complementos' => '/complementos-producto',
        'repuestos' => '/piezas-de-repuesto',
    ],

    'footer-sections' => [
        'contacto' => '/contacto',
        'sobre nosotros' => '/sobre-nosotros',
        'politica de privacidad' => '/politica-de-privacidad',
    ],

    /**
     * Categories to show in the main page after banner
     */
    'featured-categories' => [
        1,
        2,
        3,
        4,
    ],

    /**
     * Products to show in the main page
     * If the array is empty, it will 15 products Products table
     * Products need to be published to be shown
     * TODO: criteria to show products
     */
    'featured-products' => [
        52,
        2,
        3,
        4,
        5,
        6,
        7,
        13,
    ],

    /**
     * Directory to save product images
     */
    'product-image-storage' => public_path('/storage/product-images'),

    /**
     * Directory to save category images
     */
    'category-image-storage' => public_path('/storage/category-images'),

    /**
     * Taxes
     */
    'tax_iva' => 0.21,

    /**
     * Mail destination addresses
     */
    'admin_email' => env('MAIL_ADMIN_EMAIL'),

    /**
     * Web logo
     */
    'web_logo' => 'https://roteco.es/wp-content/uploads/2020/12/roteco-logo-web.png',
    'web_logo_alt' => 'Roteco',
];
