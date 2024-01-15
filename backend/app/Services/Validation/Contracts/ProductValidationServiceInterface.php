<?php

namespace App\Services\Validation\Contracts;

interface ProductValidationServiceInterface
{
    public function createProductValidation(array $data): array;
}
