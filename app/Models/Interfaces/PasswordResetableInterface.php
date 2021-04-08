<?php

namespace App\Models\Interfaces;

use App\Models\PasswordReset;
use Illuminate\Database\Eloquent\Relations\MorphOne;

/**
 * @property PasswordReset passwordReset
 */
interface PasswordResetableInterface
{
    public function passwordReset(): MorphOne;

    public function getEmailField(): string;
}
