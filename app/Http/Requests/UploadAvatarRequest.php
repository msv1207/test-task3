<?php

namespace App\Http\Requests;

class UploadAvatarRequest extends UploadImageRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'avatar' => 'required|image|max:' . self::MAX_IMAGE_SIZE,
        ];
    }
}
