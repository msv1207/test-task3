<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\AbstractControllers\Auth\BaseLoginController;
use App\Http\Requests\Author\Auth\LoginRequest;
use App\Models\Admin;
use Illuminate\Http\Response;

class LoginController extends BaseLoginController
{
    public function login(LoginRequest $request): Response
    {
        $admin = $this->authService->getLoginAbleUser(
            Admin::class,
            $request->email,
            $request->password
        );

        $accessToken = $this->authService->loginUser($admin, $request->remember_me);

        return $this->successAuthResponse($accessToken, $admin);
    }

    public function logout(): Response
    {
        $this->authService->logoutUser(Admin::AUTH_GUARD);

        return $this->successDeletedResponse();
    }
}
