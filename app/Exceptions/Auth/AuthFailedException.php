<?php

namespace App\Exceptions\Auth;

use Exception;

class AuthFailedException extends Exception
{
    protected $message = 'auth_failed';
}
