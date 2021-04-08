<?php

namespace App\Http\Requests\AbstractRequests\Auth;

use Illuminate\Foundation\Http\FormRequest;

/**
 * @property string email
 * @property string password
 * @property boolean remember_me
 */
abstract class BaseLoginRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'email'       => ['required', 'string', 'email'],
            'password'    => ['required', 'string', 'max:40'],
            'remember_me' => ['nullable', 'boolean'],
        ];
    }
}
