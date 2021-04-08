<?php

namespace App\Http\Controllers\Author\Auth;

use App\Http\Controllers\AbstractControllers\Auth\BaseForgotPasswordController;
use App\Http\Requests\Author\Auth\ForgotPasswordRequest;
use App\Models\Author;
use Illuminate\Http\Response;

class ForgotPasswordController extends BaseForgotPasswordController
{
    public function sendResetEmail(ForgotPasswordRequest $request): Response
    {
        $this->passwordResetService->createPasswordReset(Author::whereEmail($request->email)->first());

        return $this->successAcceptedResponse();
    }
}
