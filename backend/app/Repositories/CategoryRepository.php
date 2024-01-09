<?php

namespace App\Repositories;

use App\Interfaces\CategoryRepositoryInterface;
use App\Models\Category;

class CategoryRepository implements CategoryRepositoryInterface
{
    public function getAllCategories()
    {
        return Category::all();
    }

    public function createCategory($category_details, $parent_id)
    {
        $category = new Category;

        $category->name = $category_details['name'];
        $category->category_id = $parent_id;

        $category->save();

        return $category;
    }
}
