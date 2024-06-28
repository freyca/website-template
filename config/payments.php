<?php

return [
    /**
     * Redsys test data
     */
    'redsys-test' => [
        'key' => env('REDSYS_TEST_KEY', ''),

        'url_ok' => env('REDSYS_TEST_URL_OK', ''),
        'url_ko' => env('REDSYS_TEST_URL_KO', ''),

        'merchantcode' => env('REDSYS_TEST_MERCHANT_CODE', ''),
        'terminal' => env('REDSYS_TEST_TERMINAL', '2'),
        'enviroment' => env('REDSYS_ENVIROMENT', 'test'),
        'url_notification' => env('REDSYS_TEST_URL_NOTIFICATION', ''),

        'tradename' => env('REDSYS_TEST_TRADENAME', ''),
        'titular' => env('REDSYS_TEST_TITULAR', ''),
        'description' => env('REDSYS_TEST_DESCRIPTION', ''),
    ],

    /**
     * Redsys real data
     */
    'redsys' => [
        'key' => env('REDSYS_KEY', ''),

        'url_ok' => env('REDSYS_URL_OK', ''),
        'url_ko' => env('REDSYS_URL_KO', ''),

        'merchantcode' => env('REDSYS_MERCHANT_CODE', ''),
        'terminal' => env('REDSYS_TERMINAL', '2'),
        'enviroment' => env('REDSYS_ENVIROMENT', 'prod'),
        'url_notification' => env('REDSYS_URL_NOTIFICATION', ''),

        'tradename' => env('REDSYS_TRADENAME', ''),
        'titular' => env('REDSYS_TITULAR', ''),
        'description' => env('REDSYS_DESCRIPTION', ''),

    ],
];
