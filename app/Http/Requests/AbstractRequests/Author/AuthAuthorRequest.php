<?php

namespace App\Http\Requests\AbstractRequests\Author;

use App\Models\Author;
use Illuminate\Foundation\Http\FormRequest;

abstract class AuthAuthorRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return auth(Author::AUTH_GUARD)->check();
    }

    protected function getAuthCustomer(): Author
    {
        return auth(Author::AUTH_GUARD)->user();
    }
}
