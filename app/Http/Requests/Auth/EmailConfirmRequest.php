<?php

namespace App\Http\Requests\Auth;

use App\Models\EmailConfirm;
use App\Rules\EmailConfirmToken;
use Illuminate\Foundation\Http\FormRequest;

/**
 * @property string confirm_token
 * @property EmailConfirm email_confirm
 */
class EmailConfirmRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'confirm_token' => ['required', 'string', new EmailConfirmToken($this->email_confirm)],
        ];
    }
}
