<?php

namespace App\Http\Requests\Admin\Auth;

use App\Http\Requests\AbstractRequests\Auth\BaseLoginRequest;

class LoginRequest extends BaseLoginRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        // Change rules here if needed

        return parent::rules();
    }
}
