<?php

namespace App\Http\Requests\AbstractRequests\Auth;

use Illuminate\Foundation\Http\FormRequest;

/**
 * @property string email
 */
abstract class BaseForgotPasswordRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'email' => ['required', 'string', 'email'],
        ];
    }
}
