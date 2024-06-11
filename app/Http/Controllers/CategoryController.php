<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\View\View;

class CategoryController extends Controller
{
    public function index(Category $category): View
    {
        $category = $category::with('products')->where('published', true)->simplePaginate(15);

        return view('category', [
            'category' => $category,
        ]);
    }
}
