<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\View\View;

class ProductController extends Controller
{
    public function index(Product $product): View
    {
        return view('product', ['product' => $product]);
    }
}
