<?php

namespace App\Http\Controllers\User\Auth;

use App\Http\Controllers\AbstractControllers\Auth\BaseRegisterController;
use App\Http\Requests\User\Auth\RegisterRequest;
use App\Services\UserService;
use Illuminate\Http\Response;

class RegisterController extends BaseRegisterController
{
    public function __invoke(RegisterRequest $request, UserService $userService): Response
    {
        $newUser = $userService->create($request->validated());

        $accessToken = $this->authService->loginUser($newUser, $request->remember_me);

        return $this->successRegisteredResponse($accessToken, $newUser);
    }
}
