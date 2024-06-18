<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SeoController;
use Illuminate\Support\Facades\Route;

Route::middleware('frontend')->group(function () {
    Route::get('/', [HomeController::class, 'index']);

    Route::get('quienes-somos', function () {
        return view('who-we-are');
    });

    Route::get('como-comprar', function () {
        return view('how-to-buy');
    });

    Route::get('sobre-nosotros', function () {
        return view('about-us');
    });

    Route::get('contacto', function () {
        return view('contact');
    });

    /** Cart */
    Route::prefix('carrito')->name('cart.')->group(function () {
        Route::get('/', function () {
            return view('cart');
        });

        Route::get('products', [CartController::class, 'index'])->name('index');
        Route::put('{product}', [CartController::class, 'store'])->name('add');
        Route::post('clear', [CartController::class, 'clear'])->name('clear');
        Route::delete('{product}', [CartController::class, 'delete'])->name('delete-product');
    });

    /** Products */
    Route::get('/productos', [ProductController::class, 'all']);
    Route::get('producto/{product}', [ProductController::class, 'product']);
    Route::get('/complementos-producto', [ProductController::class, 'complements']);
    Route::get('complemento/{productComplement}', [ProductController::class, 'productComplement']);
    Route::get('/piezas-de-repuesto', [ProductController::class, 'spareParts']);
    Route::get('pieza-de-repuesto/{productSparePart}', [ProductController::class, 'productSparePart']);

    /** Seo URL's */
    Route::get('/desbrozadoras-por-menos-de-1000-euros', [SeoController::class, 'desbrozadorasBaratas']);

    /** Categories */
    Route::get('categorias', [CategoryController::class, 'index']);
    Route::get('{category}', [CategoryController::class, 'category']);
});
