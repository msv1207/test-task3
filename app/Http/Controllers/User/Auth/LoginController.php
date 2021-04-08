<?php

namespace App\Http\Controllers\User\Auth;

use App\Http\Controllers\AbstractControllers\Auth\BaseLoginController;
use App\Http\Requests\Author\Auth\LoginRequest;
use App\Models\User;
use Illuminate\Http\Response;

class LoginController extends BaseLoginController
{
    public function login(LoginRequest $request): Response
    {
        $user = $this->authService->getLoginAbleUser(
            User::class,
            $request->email,
            $request->password
        );

        $accessToken = $this->authService->loginUser($user, $request->remember_me);

        return $this->successAuthResponse($accessToken, $user);
    }

    public function logout(): Response
    {
        $this->authService->logoutUser(User::AUTH_GUARD);

        return $this->successDeletedResponse();
    }
}
