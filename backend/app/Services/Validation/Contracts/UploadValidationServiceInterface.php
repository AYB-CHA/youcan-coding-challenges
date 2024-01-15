<?php

namespace App\Services\Validation\Contracts;


interface UploadValidationServiceInterface
{
    public function storeImageValidation(array $data): array;
}
