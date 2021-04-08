<?php

namespace App\Models\Traits;

use App\Models\PasswordReset;
use Illuminate\Database\Eloquent\Relations\MorphOne;

trait PasswordResetable
{
    public function passwordReset(): MorphOne
    {
        return $this->morphOne(PasswordReset::class, 'resetable');
    }
}
