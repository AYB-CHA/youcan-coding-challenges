<?php

namespace App\Http\Controllers;

use App\Services\Validation\Contracts\CategoryValidationServiceInterface;
use App\Interfaces\CategoryRepositoryInterface;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function __construct(
        private CategoryRepositoryInterface $categoryRepository,
        private CategoryValidationServiceInterface $categoryValidationService,
    ) {
    }

    public function index()
    {
        return $this->categoryRepository->getAllCategories();
    }

    public function store(Request $request)
    {
        $this->categoryValidationService
            ->createCategoryValidation($request->all());

        $category = $this->categoryRepository->createCategory([
            'name' => $request->name,
        ], $request->parent_id);

        return [
            'name' => $category->name,
            'created_at' => $category->created_at,
        ];
    }
}
