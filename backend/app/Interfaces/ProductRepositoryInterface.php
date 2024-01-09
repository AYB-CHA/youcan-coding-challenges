<?php

namespace App\Interfaces;

interface ProductRepositoryInterface
{
    public function getAllProducts($category_id, $price_sort);
    public function createProduct($product_details, $product_categories);
}
