<?php

namespace App\Traits;

use App\Http\Resources\LoginAbleResource;
use App\Models\Interfaces\LoginAbleInterface;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Response;

trait HttpResponses
{
    protected function successResponse($data = null): Response
    {
        return response($data);
    }

    protected function successAuthResponse(string $token, LoginAbleInterface $loginAble): Response
    {
        return response([
            'access_token' => $token,
            'user'         => new LoginAbleResource($loginAble),
        ]);
    }

    protected function successRegisteredResponse(string $token, LoginAbleInterface $loginAble): Response
    {
        return response([
            'access_token' => $token,
            'user'         => new LoginAbleResource($loginAble),
        ], Response::HTTP_CREATED);
    }

    protected function failedAuthResponse(): Response
    {
        return $this->responseWithError('invalid_credentials');
    }

    protected function successAcceptedResponse(?JsonResource $resource = null): Response
    {
        return response($resource, Response::HTTP_ACCEPTED);
    }

    protected function successCreatedResponse(?JsonResource $resource = null): Response
    {
        return response($resource, Response::HTTP_CREATED);
    }

    protected function successUpdatedResponse(?JsonResource $resource = null): Response
    {
        return response($resource);
    }

    protected function successDeletedResponse(): Response
    {
        return response()->noContent();
    }

    protected function responseWithError(?string $message, int $status = Response::HTTP_FORBIDDEN): Response
    {
        return response(['message' => $message], $status);
    }
}
