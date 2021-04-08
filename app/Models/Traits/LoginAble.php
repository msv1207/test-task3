<?php

namespace App\Models\Traits;

trait LoginAble
{
    public function getAuthGuard(): string
    {
        return self::AUTH_GUARD;
    }

    public function getJWTIdentifier(): int
    {
        return $this->id;
    }

    public function getJWTCustomClaims(): array
    {
        return [];
    }
}
