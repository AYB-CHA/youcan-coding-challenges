<?php

namespace App\Services\Validation;

use App\Services\Validation\Contracts\ProductValidationServiceInterface;
use Illuminate\Validation\Rule;
use App\Models\Category;

class ProductValidationService extends Validation
implements ProductValidationServiceInterface
{
    public function createProductValidation(array $data): array
    {
        return $this->validate($data, [
            'name' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'price' => ['required', 'numeric', 'gt:0'],
            'image' => ['required', 'url'],
            'categories' => ['nullable', 'array'],
            'categories.*' => [
                'numeric',
                Rule::exists(Category::class, 'id'),
            ],
        ]);
    }
}
