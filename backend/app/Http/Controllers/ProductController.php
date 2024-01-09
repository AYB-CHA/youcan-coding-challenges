<?php

namespace App\Http\Controllers;

use App\Interfaces\ProductRepositoryInterface;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ProductController extends Controller
{
    public function __construct(
        private ProductRepositoryInterface $productRepository,
    ) {
    }

    public function index(Request $request)
    {
        $price_sorting = $request->has('sort') ? 'asc' : 'desc';
        $category_id = $request->query('category_id');

        return $this->productRepository->getAllProducts($category_id, $price_sorting);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'price' => ['required', 'numeric', 'gt:0'],
            'image' => ['required', 'url'],
            'categories' => ['nullable', 'array'],
            'categories.*' => [
                'numeric',
                Rule::exists(Category::class, 'id'),
            ],
        ]);

        unset($validated['categories']);

        $product = $this->productRepository->createProduct(
            $validated,
            $request->categories,
        );
        return $product;
    }
}
