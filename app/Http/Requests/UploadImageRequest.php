<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UploadImageRequest extends FormRequest
{
    /**
     * @const MAX_IMAGE_SIZE - default 32768 bytes = 32 mb
     */
    public const MAX_IMAGE_SIZE = 32768;

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'image' => 'required|image|max:' . self::MAX_IMAGE_SIZE,
        ];
    }
}
