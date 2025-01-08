<?php

return [
    'enviroment' => env('PAYMENT_APP_ENV', 'test'),

    /**
     * Redsys test data
     */
    'redsys-test' => [
        'key' => env('REDSYS_TEST_KEY', 'sq7HjrUOBfKmC576ILgskD5srU870gJ7'),

        'url_ok' => env('PAYMENT_URL_OK', ''),
        'url_ko' => env('PAYMENT_URL_KO', ''),

        'merchantcode' => env('REDSYS_TEST_MERCHANT_CODE', '999008881'),
        'terminal' => env('REDSYS_TEST_TERMINAL', '1'),
        'enviroment' => env('REDSYS_ENVIROMENT', 'test'),
        'url_notification' => env('PAYMENT_URL_NOTIFICATION', ''),

        'tradename' => env('REDSYS_TRADENAME', ''),
        'titular' => env('REDSYS_TITULAR', ''),
        'description' => env('REDSYS_DESCRIPTION', ''),
    ],

    /**
     * Redsys real data
     */
    'redsys' => [
        'terminal' => env('REDSYS_TERMINAL', 1),
        'key' => env('REDSYS_KEY', ''),

        'url_ok' => env('PAYMENT_URL_OK', ''),
        'url_ko' => env('PAYMENT_URL_KO', ''),

        'merchantcode' => env('REDSYS_MERCHANT_CODE'),
        'terminal' => env('REDSYS_TERMINAL', '2'),
        'enviroment' => env('REDSYS_ENVIROMENT', 'prod'),
        'url_notification' => env('PAYMENT_URL_NOTIFICATION', ''),

        'tradename' => env('REDSYS_TRADENAME', ''),
        'titular' => env('REDSYS_TITULAR', ''),
        'description' => env('REDSYS_DESCRIPTION', ''),

    ],
];
