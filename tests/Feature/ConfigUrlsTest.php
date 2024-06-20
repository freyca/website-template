<?php

use function Pest\Laravel\{get};

test('urls in configuration file returns OK', function (string $url) {
    $response = get($url);
    $response->assertStatus(200);
})->with('configurls');
