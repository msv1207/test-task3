<?php

namespace App\Http\Requests\Auth;

use App\Models\PasswordReset;
use App\Rules\PasswordResetToken;
use Illuminate\Foundation\Http\FormRequest;

/**
 * @property PasswordReset password_reset
 *
 * @property string password
 */
class PasswordResetRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'reset_token' => ['required', 'string', new PasswordResetToken($this->password_reset)],
            'password'    => 'required|string|max:40|confirmed',
        ];
    }
}
