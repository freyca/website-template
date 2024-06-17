<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Repositories\Categories\CategoryRepositoryInterface;
use App\Repositories\Product\Product\ProductRepositoryInterface;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function __construct(
        private CategoryRepositoryInterface $categoryRepository,
        private ProductRepositoryInterface $productRepository,
    ) {
    }

    public function index(): View
    {
        $categories = $this->categoryRepository->featured();
        $products = $this->productRepository->featured();

        return view(
            'index',
            [
                'categories' => $categories,
                'products' => $products,
            ]
        );
    }
}
