<?php

namespace App\Rules;

use App\Models\PasswordReset;
use App\Services\PasswordResetService;
use Illuminate\Contracts\Validation\Rule;

class PasswordResetToken implements Rule
{
    private PasswordReset $passwordReset;
    private PasswordResetService $passwordResetService;

    /**
     * Create a new rule instance.
     *
     * @param PasswordReset $passwordReset
     */
    public function __construct(PasswordReset $passwordReset)
    {
        $this->passwordReset = $passwordReset;
        $this->passwordResetService = resolve(PasswordResetService::class);
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param string $attribute
     * @param string $resetToken
     * @return bool
     */
    public function passes($attribute, $resetToken): bool
    {
        return $this->passwordResetService->checkResetToken($this->passwordReset, $resetToken);
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
