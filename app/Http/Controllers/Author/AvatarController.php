<?php

namespace App\Http\Controllers\Author;

use App\Http\Controllers\AbstractControllers\Author\AuthAuthorController;
use App\Http\Requests\UploadAvatarRequest;
use App\Http\Resources\ImageResource;
use App\Services\AvatarService;
use Illuminate\Http\Response;

class AvatarController extends AuthAuthorController
{
    private AvatarService $avatarService;

    public function __construct(AvatarService $avatarService)
    {
        parent::__construct();

        $this->avatarService = $avatarService;
    }

    public function show(): Response
    {
        $avatar = $this->authAuthor->avatar()->firstOrFail();

        return $this->successResponse(new ImageResource($avatar));
    }

    public function upload(UploadAvatarRequest $request): Response
    {
        $avatar = $this->avatarService
            ->setStorage('public')
            ->setBasePath($this->getStorageBasePath())
            ->upload($this->authAuthor, $request->file('avatar'));

        return $this->successResponse(new ImageResource($avatar));
    }

    public function delete(): Response
    {
        $avatar = $this->authAuthor->avatar()->firstOrFail();

        $this->avatarService->delete($avatar);

        return $this->successDeletedResponse();
    }
}
