<?php

namespace App\Http\Controllers\PublicControllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\EmailConfirmRequest;
use App\Models\EmailConfirm;
use App\Services\EmailConfirmService;
use Illuminate\Http\Response;

class EmailConfirmController extends Controller
{
    public function __invoke(
        EmailConfirm $emailConfirm,
        EmailConfirmRequest $request,
        EmailConfirmService $emailConfirmService
    ): Response
    {
        $emailConfirmService->confirmEmail($emailConfirm, $request->confirm_token);

        return $this->successResponse();
    }
}
