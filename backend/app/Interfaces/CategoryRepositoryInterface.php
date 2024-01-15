<?php

namespace App\Interfaces;

use Illuminate\Database\Eloquent\Collection;

interface CategoryRepositoryInterface
{
    public function getAllCategories(): Collection;
    public function createCategory(array $category_details, int|null $parent_category);
}
