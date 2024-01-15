<?php

namespace App\Repositories;

use App\Interfaces\CategoryRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;
use App\Models\Category;

class CategoryRepository implements CategoryRepositoryInterface
{
    public function getAllCategories(): Collection
    {
        return Category::all();
    }

    public function createCategory(
        array $category_details,
        int $parent_id
    ): Category {
        $category = new Category;

        $category->name = $category_details['name'];
        $category->category_id = $parent_id;

        $category->save();

        return $category;
    }
}
