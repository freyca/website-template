<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SeoController;
use Illuminate\Support\Facades\Route;

Route::get(
    '/',
    [HomeController::class, 'index']
)->name('home');

Route::get('quienes-somos', function () {
    return view('who-we-are');
})->name('who-we-are');

Route::get('como-comprar', function () {
    return view('how-to-buy');
})->name('how-to-buy');

Route::get('sobre-nosotros', function () {
    return view('about-us');
})->name('about-us');

Route::get('contacto', function () {
    return view('contact');
})->name('contact');

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
Route::get('/productos', [ProductController::class, 'all'])->name('product-list');
Route::get('producto/{product}', [ProductController::class, 'product'])->name('product');
Route::get('/complementos-producto', [ProductController::class, 'complements'])->name('complement-list');
Route::get('complemento/{productComplement}', [ProductController::class, 'productComplement'])->name('complement');
Route::get('/piezas-de-repuesto', [ProductController::class, 'spareParts'])->name('spare-part-list');
Route::get('pieza-de-repuesto/{productSparePart}', [ProductController::class, 'productSparePart'])->name('spare-part');

/** Seo URL's */
Route::name('seo.')->group(function () {
    Route::get('/desbrozadoras-por-menos-de-1000-euros', [SeoController::class, 'desbrozadorasBaratas'])->name('desbrozadoras-baratas');
});

/** Categories */
Route::get('categorias', [CategoryController::class, 'index'])->name('category-list');
Route::get('{category}', [CategoryController::class, 'category'])->name('category');
