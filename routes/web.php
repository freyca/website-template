<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ProductController;
use App\Livewire\ContactForm;
use Illuminate\Support\Facades\Route;

Route::middleware('frontend')->group(function () {
    Route::get('/', function () {
        return view('index');
    });

    Route::get('/quienes-somos', function () {
        return view('who-we-are');
    });

    Route::get('como-comprar', function () {
        return view('how-to-buy');
    });

    /** Contact */
    Route::get('/contacto', [ContactController::class, 'index']);
    Route::post('/contacto', ContactForm::class);

    /** Cart */
    Route::prefix('carrito')->name('cart.')->group(function () {
        Route::get('/', function () {
            return view('cart');
        });

        Route::get('/products', [CartController::class, 'index'])->name('index');
        Route::put('/{product}', [CartController::class, 'store'])->name('add');
        Route::post('/clear', [CartController::class, 'clear'])->name('clear');
        Route::delete('/{product}', [CartController::class, 'delete'])->name('delete-product');
    });

    /** Categories */
    Route::get('/{category:name}', [CategoryController::class, 'index']);

    /** Products */
    Route::get('/producto/{product:name}', [ProductController::class, 'index']);
});
