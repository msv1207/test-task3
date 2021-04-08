<?php

namespace App\Models\Interfaces;

use App\Models\EmailConfirm;
use Illuminate\Database\Eloquent\Relations\MorphOne;

/**
 * @property EmailConfirm emailConfirm
 */
interface EmailConfirmableInterface
{
    public function emailConfirm(): MorphOne;

    public function getEmailField(): string;

    public function getEmailConfirmedAtField(): string;
}
