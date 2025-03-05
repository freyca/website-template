<?php

namespace App\Http\Controllers;

use App\DTO\SeoTags;
use Illuminate\View\View;

class CartController extends Controller
{
    public function index(): View
    {
        return view('pages.cart', [
            'seotags' => new SeoTags('noindex'),
        ]);
    }
}
