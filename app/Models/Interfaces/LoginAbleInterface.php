<?php

namespace App\Models\Interfaces;

use Tymon\JWTAuth\Contracts\JWTSubject;

/**
 * @property string email
 * @property string password
 */
interface LoginAbleInterface extends JWTSubject
{
    public function getAuthGuard(): string;
}
