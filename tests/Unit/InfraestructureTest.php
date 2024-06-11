<?php

declare(strict_types=1);

it('Ensures custom form request used in controllers', function () {

    expect('Illuminate\Http\Request')
        ->not
        ->toBeUsedIn('App\Http\Controllers');
});

it('Ensures that no debugging commands are present in the code ready to commit', function () {

    expect(['dd', 'dump', 'ray', 'var_dump', 'info', 'error_log'])
        ->not
        ->toBeUsed();
});

it('Ensures env command not used outside config files', function () {

    expect(['env'])
        ->not
        ->toBeUsed();
});

it('Ensures that strict_types is declared in all classes', function () {

    expect('App')
        ->toUseStrictTypes();
});

it('Controllers must have Controller sufix', function () {

    expect('App\Http\Controllers')
        ->toHaveSuffix('Controller');
});
