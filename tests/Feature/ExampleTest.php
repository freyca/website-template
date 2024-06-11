<?php

namespace Tests\Feature;

test('application returns a successful response', function () {
    $response = $this->get('/');

    $response->assertStatus(200);
});
