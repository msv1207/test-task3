<?php

namespace App\Http\Requests\Author\Auth;

use App\Http\Requests\AbstractRequests\Auth\BaseRegisterRequest;

class RegisterRequest extends BaseRegisterRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        $rules = parent::rules();

        $rules['email'][] = 'unique:authors';

        return $rules;
    }
}
