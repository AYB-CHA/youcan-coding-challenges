<?php

namespace App\Services\Validation;

use App\Services\Validation\Contracts\UploadValidationServiceInterface;

class UploadValidationService extends Validation
implements UploadValidationServiceInterface
{
    public function storeImageValidation(array $data): array
    {
        return $this->validate($data, [
            'image' => ['required', 'image', 'mimes:jpg,png,jpeg', 'max:2048'],
        ]);
    }
}
