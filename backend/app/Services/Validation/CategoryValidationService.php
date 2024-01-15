<?php

namespace App\Services\Validation;

use App\Services\Validation\Contracts\CategoryValidationServiceInterface;
use Illuminate\Validation\Rule;
use App\Models\Category;

class CategoryValidationService extends Validation
implements CategoryValidationServiceInterface
{
    public function createCategoryValidation(array $data): array
    {
        return $this->validate($data, [
            'name' => [
                'required',
                'string',
                'max:255',
            ],
            'parent_id' => [
                'nullable',
                Rule::exists(Category::class, 'id')
            ],
        ]);
    }
}
