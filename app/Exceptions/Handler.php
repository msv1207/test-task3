<?php

namespace App\Exceptions;

use App\Traits\HttpResponses;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Throwable;

class Handler extends ExceptionHandler
{
    use HttpResponses;

    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     *
     * @return void
     */
    public function register()
    {
        $this->reportable(function (Throwable $exception) {
            if (app()->bound('sentry') && $this->shouldReport($exception)) {
                app('sentry')->captureException($exception);
            }
        });
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param Request $request
     * @param Throwable $exception
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @throws Throwable
     */
    public function render($request, Throwable $exception)
    {
        /*
         * Auth Exceptions
         */

        if ($exception instanceof Auth\AuthFailedException) {
            return $this->failedAuthResponse();
        }

        if ($exception instanceof \Illuminate\Auth\AuthenticationException) {
            return $this->responseWithError('unauthorized', Response::HTTP_UNAUTHORIZED);
        }

        return parent::render($request, $exception);
    }
}
