<?php

namespace App\Services\Validation\Contracts;

interface CategoryValidationServiceInterface
{
    public function createCategoryValidation(array $data): array;
}
