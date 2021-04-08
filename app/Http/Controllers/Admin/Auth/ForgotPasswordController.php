<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\AbstractControllers\Auth\BaseForgotPasswordController;
use App\Http\Requests\Admin\Auth\ForgotPasswordRequest;
use App\Models\Admin;
use Illuminate\Http\Response;

class ForgotPasswordController extends BaseForgotPasswordController
{
    public function sendResetEmail(ForgotPasswordRequest $request): Response
    {
        $this->passwordResetService->createPasswordReset(Admin::whereEmail($request->email)->first());

        return $this->successAcceptedResponse();
    }
}
