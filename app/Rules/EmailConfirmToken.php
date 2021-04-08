<?php

namespace App\Rules;

use App\Models\EmailConfirm;
use App\Services\EmailConfirmService;
use Illuminate\Contracts\Validation\Rule;

class EmailConfirmToken implements Rule
{
    private EmailConfirm $emailConfirm;
    private EmailConfirmService $emailConfirmService;

    /**
     * Create a new rule instance.
     *
     * @param EmailConfirm $emailConfirm
     */
    public function __construct(EmailConfirm $emailConfirm)
    {
        $this->emailConfirm = $emailConfirm;
        $this->emailConfirmService = resolve(EmailConfirmService::class);
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param string $attribute
     * @param string $token
     * @return bool
     */
    public function passes($attribute, $token): bool
    {
        return $this->emailConfirmService->checkTokenIfValid($this->emailConfirm, $token);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message(): string
    {
        return 'The :attribute is invalid.';
    }
}
