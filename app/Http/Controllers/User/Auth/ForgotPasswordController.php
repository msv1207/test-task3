<?php

namespace App\Http\Controllers\User\Auth;

use App\Http\Controllers\AbstractControllers\Auth\BaseForgotPasswordController;
use App\Http\Requests\User\Auth\ForgotPasswordRequest;
use App\Models\User;
use Illuminate\Http\Response;

class ForgotPasswordController extends BaseForgotPasswordController
{
    public function sendResetEmail(ForgotPasswordRequest $request): Response
    {
        $this->passwordResetService->createPasswordReset(User::whereEmail($request->email)->first());

        return $this->successAcceptedResponse();
    }
}
