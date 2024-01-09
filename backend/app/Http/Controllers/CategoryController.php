<?php

namespace App\Http\Controllers;

use App\Interfaces\CategoryRepositoryInterface;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class CategoryController extends Controller
{
    public function __construct(
        private CategoryRepositoryInterface $categoryRepository
    ) {
    }

    public function index()
    {
        return $this->categoryRepository->getAllCategories();
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => [
                'required',
                'string',
                'max:255'
            ],
            'parent_id' => [
                'nullable',
                Rule::exists(Category::class, 'id')
            ],
        ]);

        $category = $this->categoryRepository->createCategory([
            'name' => $request->name,
        ], $request->parent_id);

        return [
            'name' => $category->name,
            'created_at' => $category->created_at,
        ];
    }
}
