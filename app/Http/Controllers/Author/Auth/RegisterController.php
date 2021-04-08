<?php

namespace App\Http\Controllers\Author\Auth;

use App\Http\Controllers\AbstractControllers\Auth\BaseRegisterController;
use App\Http\Requests\Author\Auth\RegisterRequest;
use App\Services\AuthorService;
use Illuminate\Http\Response;

class RegisterController extends BaseRegisterController
{
    public function __invoke(RegisterRequest $request, AuthorService $authorService): Response
    {
        $newAuthor = $authorService->create($request->validated());

        $accessToken = $this->authService->loginUser($newAuthor, $request->remember_me);

        return $this->successRegisteredResponse($accessToken, $newAuthor);
    }
}
