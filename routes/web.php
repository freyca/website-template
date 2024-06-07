<?php

use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


Route::middleware('frontend')->group(function () {
    Route::get('/', function () {
        return view('index');
    });

    Route::get('/{category:name}', function (Category $category) {
        dump(Auth::getUser());
        return view('category', ['category' => $category]);
    });

    Route::get('/producto/{product:name}', function (Product $product) {
        return view('product', ['product' => $product]);
    });
});
