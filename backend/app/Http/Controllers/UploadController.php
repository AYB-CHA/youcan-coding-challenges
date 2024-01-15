<?php

namespace App\Http\Controllers;

use App\Services\Validation\Contracts\UploadValidationServiceInterface;
use Symfony\Component\CssSelector\Exception\InternalErrorException;
use Illuminate\Http\Request;

class UploadController extends Controller
{
    public function __construct(
        private UploadValidationServiceInterface $uploadValidationService,
    ) {
    }

    public function storeImage(Request $request): array
    {
        $this->uploadValidationService->storeImageValidation($request->all());

        $filename = $request->file('image')->store('/images', ['disk' => 'public']);
        if (!$filename)
            throw new InternalErrorException('Can\'t Upload Image.');

        return [
            'url' => url('/storage/' . $filename),
        ];
    }
}
