<?php

namespace App\Http\Requests\AbstractRequests\Auth;

use Illuminate\Foundation\Http\FormRequest;

/**
 * @property string email
 * @property string password
 * @property boolean agree_rules
 * @property boolean remember_me
 */
abstract class BaseRegisterRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'name'        => ['required', 'string', 'min:2', 'max:100'],
            'email'       => ['required', 'string', 'email'],
            'password'    => ['required', 'string', 'max:40', 'confirmed'],
            'agree_rules' => ['required', 'accepted'],
            'remember_me' => ['nullable', 'boolean'],
        ];
    }
}
