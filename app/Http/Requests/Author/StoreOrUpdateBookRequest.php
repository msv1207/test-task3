<?php

namespace App\Http\Requests\Author;

use App\Http\Requests\AbstractRequests\Author\AuthAuthorRequest;
use App\Http\Requests\UploadImageRequest;

class StoreOrUpdateBookRequest extends AuthAuthorRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'title'             => 'required|string|min:10|max:255',
            'short_description' => 'required|string|min:10|max:500',
            'description'       => 'required|string|min:10|max:10000',
            'image'             => 'required|image|max:' . UploadImageRequest::MAX_IMAGE_SIZE,
        ];
    }
}
