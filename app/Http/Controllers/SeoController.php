<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\View\View;

class SeoController extends Controller
{
    public function desbrozadorasBaratas(): View
    {
        return view(
            'products',
            [
                'products' => Product::whereIn(
                    'category_id',
                    Category::where(
                        'name',
                        'Intuitive discrete collaboration'
                    )->pluck('id')
                )->get(),
            ]
        );
    }
}
