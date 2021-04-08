<?php

namespace App\Models\Traits;

use App\Models\EmailConfirm;
use Illuminate\Database\Eloquent\Relations\MorphOne;

trait EmailConfirmable
{
    public function emailConfirm(): MorphOne
    {
        return $this->morphOne(EmailConfirm::class, 'email_confirmable');
    }

    public function getEmailConfirmedAtField(): string
    {
        return 'email_confirmed_at';
    }

    public function getEmailField(): string
    {
        return 'email';
    }
}
