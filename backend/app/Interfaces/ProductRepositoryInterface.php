<?php

namespace App\Interfaces;

use App\Models\Product;
use Illuminate\Database\Eloquent\Collection;

interface ProductRepositoryInterface
{
    public function getAllProducts(int $category_id, string $price_sort): Collection;
    public function createProduct(array $product_details, array $product_categories): Product;
}
