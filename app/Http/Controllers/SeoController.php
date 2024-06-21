<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Repositories\Database\Categories\CategoryRepositoryInterface;
use Illuminate\View\View;

class SeoController extends Controller
{
    public function __construct(private CategoryRepositoryInterface $categoryRepository)
    {
    }

    public function desbrozadorasBaratas(): View
    {
        /**
         * @var \App\Models\Category
         */
        $category = $this->categoryRepository->getAll()->first();
        $products = $this->categoryRepository->getProducts($category);

        return view(
            'products',
            [
                'products' => $products,
            ]
        );
    }
}
