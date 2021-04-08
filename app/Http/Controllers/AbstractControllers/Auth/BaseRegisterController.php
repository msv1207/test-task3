<?php

namespace App\Http\Controllers\AbstractControllers\Auth;

use App\Http\Controllers\Controller;
use App\Services\AuthService;

abstract class BaseRegisterController extends Controller
{
    protected AuthService $authService;

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }
}
