<?php

namespace App\Http\Controllers\Author\Auth;

use App\Http\Controllers\AbstractControllers\Auth\BaseLoginController;
use App\Http\Requests\Author\Auth\LoginRequest;
use App\Models\Author;
use Illuminate\Http\Response;

class LoginController extends BaseLoginController
{
    public function login(LoginRequest $request): Response
    {
        $author = $this->authService->getLoginAbleUser(
            Author::class,
            $request->email,
            $request->password
        );

        $accessToken = $this->authService->loginUser($author, $request->remember_me);

        return $this->successAuthResponse($accessToken, $author);
    }

    public function logout(): Response
    {
        $this->authService->logoutUser(Author::AUTH_GUARD);

        return $this->successDeletedResponse();
    }
}
