<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\AbstractControllers\User\AuthUserController;
use App\Http\Requests\UploadAvatarRequest;
use App\Http\Resources\ImageResource;
use App\Services\AvatarService;
use Illuminate\Http\Response;

class AvatarController extends AuthUserController
{
    private AvatarService $avatarService;

    public function __construct(AvatarService $avatarService)
    {
        parent::__construct();

        $this->avatarService = $avatarService;
    }

    public function show(): Response
    {
        $avatar = $this->authUser->avatar()->firstOrFail();

        return $this->successResponse(new ImageResource($avatar));
    }

    public function upload(UploadAvatarRequest $request): Response
    {
        $avatar = $this->avatarService
            ->setStorage('public')
            ->setBasePath($this->getStorageBasePath())
            ->upload($this->authUser, $request->file('avatar'));

        return $this->successResponse(new ImageResource($avatar));
    }

    public function delete(): Response
    {
        $avatar = $this->authUser->avatar()->firstOrFail();

        $this->avatarService->delete($avatar);

        return $this->successDeletedResponse();
    }
}
