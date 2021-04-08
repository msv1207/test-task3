<?php

namespace App\Http\Controllers\AbstractControllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\PasswordResetRequest;
use App\Models\PasswordReset;
use App\Services\PasswordResetService;
use Illuminate\Http\Response;

abstract class BaseForgotPasswordController extends Controller
{
    protected PasswordResetService $passwordResetService;

    public function __construct(PasswordResetService $passwordResetService)
    {
        $this->passwordResetService = $passwordResetService;
    }

    public function resetPassword(PasswordReset $passwordReset, PasswordResetRequest $request): Response
    {
        $this->passwordResetService->resetPassword($passwordReset, ['password' => $request->password]);

        return $this->successResponse();
    }
}
