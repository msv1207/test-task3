<?php

namespace App\Http\Controllers\AbstractControllers\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use Closure;
use Illuminate\Http\Request;

abstract class AuthUserController extends Controller
{
    protected User $authUser;

    public function __construct()
    {
        $this->middleware('auth:' . User::AUTH_GUARD);
        $this->middleware(function (Request $request, Closure $next) {
            $this->authUser = auth(User::AUTH_GUARD)->user();

            return $next($request);
        });
    }

    protected function getStorageBasePath(): string
    {
        return "users/{$this->authUser->id}";
    }
}
