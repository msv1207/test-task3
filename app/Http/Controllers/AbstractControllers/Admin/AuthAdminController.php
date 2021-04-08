<?php

namespace App\Http\Controllers\AbstractControllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Closure;
use Illuminate\Http\Request;

abstract class AuthAdminController extends Controller
{
    protected Admin $authAdmin;

    public function __construct()
    {
        $this->middleware('auth:' . Admin::AUTH_GUARD);
        $this->middleware(function (Request $request, Closure $next) {
            $this->authAdmin = auth(Admin::AUTH_GUARD)->user();

            return $next($request);
        });
    }
}
