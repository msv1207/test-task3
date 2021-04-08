<?php

namespace App\Http\Requests\Author\Auth;

use App\Http\Requests\AbstractRequests\Auth\BaseForgotPasswordRequest;

class ForgotPasswordRequest extends BaseForgotPasswordRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        $rules = parent::rules();

        $rules['email'][] = 'exists:authors';

        return $rules;
    }
}