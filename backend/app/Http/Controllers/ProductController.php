<?php

namespace App\Http\Controllers;

use App\Services\Validation\Contracts\ProductValidationServiceInterface;
use App\Interfaces\ProductRepositoryInterface;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function __construct(
        private ProductRepositoryInterface $productRepository,
        private ProductValidationServiceInterface $productValidationService,
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
        $validated = $this->productValidationService
            ->createProductValidation($request->all());

        unset($validated['categories']);

        $product = $this->productRepository->createProduct(
            $validated,
            $request->categories,
        );
        return $product;
    }
}
