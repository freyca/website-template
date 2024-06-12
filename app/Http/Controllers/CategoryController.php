<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\View\View;

class CategoryController extends Controller
{
    public function index(): View
    {
        $categories = Category::all();

        return view('categories', ['categories' => $categories]);
    }

    public function category(Category $category): View
    {
        $products = $category->products()->where('published', true)->get();

        return view('category', [
            'category' => $category,
            'products' => $products,
        ]);
    }
}
