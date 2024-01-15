<?php

namespace App\Http\Controllers;

use App\Services\Validation\Contracts\ProductValidationServiceInterface;
use App\Interfaces\ProductRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    public function __construct(
        private ProductRepositoryInterface $productRepository,
        private ProductValidationServiceInterface $productValidationService,
    ) {
    }

    public function index(Request $request): Collection
    {
        $price_sorting = $request->has('sort') ? 'asc' : 'desc';
        $category_id = $request->query('category_id');

        return $this->productRepository->getAllProducts($category_id, $price_sorting);
    }

    public function store(Request $request): Product
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
