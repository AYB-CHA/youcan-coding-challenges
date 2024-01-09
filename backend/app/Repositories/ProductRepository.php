<?php

namespace App\Repositories;

use App\Interfaces\ProductRepositoryInterface;
use App\Models\Product;

class ProductRepository implements ProductRepositoryInterface
{
    public function getAllProducts($category_id, $price_sort)
    {
        return Product::select()
            ->when(
                $category_id,
                fn ($query) => $query->whereHas(
                    'categories',
                    fn ($q) => $q->where('categories.id', $category_id)
                )
            )
            ->orderBy('price', $price_sort)
            ->with('categories')
            ->get();
    }

    public function createProduct($product_details, $product_categories)
    {
        $product = Product::create($product_details);
        $product->categories()->attach($product_categories);
        return $product;
    }
}
