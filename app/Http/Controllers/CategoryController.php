<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Category;
use App\Repositories\Categories\CategoryRepositoryInterface;
use Illuminate\View\View;

class CategoryController extends Controller
{
    public function __construct(
        private CategoryRepositoryInterface $repository
    ) {
    }

    public function index(): View
    {
        $categories = $this->repository->getAll();

        return view('categories', ['categories' => $categories]);
    }

    public function category(Category $category): View
    {
        $products = $this->repository->getProducts($category);

        return view('category', [
            'category' => $category,
            'products' => $products,
        ]);
    }
}
