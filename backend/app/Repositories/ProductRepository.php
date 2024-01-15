<?php

namespace App\Repositories;

use App\Interfaces\ProductRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;
use App\Models\Product;

class ProductRepository implements ProductRepositoryInterface
{
    public function getAllProducts(
        int|null $category_id,
        string $price_sort,
    ): Collection {
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

    public function createProduct(
        array $product_details,
        array $product_categories,
    ): Product {
        $product = Product::create($product_details);
        $product->categories()->attach($product_categories);
        return $product;
    }
}
