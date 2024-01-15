<?php

namespace App\Services\Validation;

use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Validator;

abstract class Validation
{
    protected function validate(array $data, array $rules): array
    {
        $validator = Validator::make($data, $rules);

        if ($validator->failed())
            throw new ValidationException($validator);

        return $validator->validated();
    }
}
