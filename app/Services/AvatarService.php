<?php

namespace App\Services;

use App\Models\Image;
use App\Models\Interfaces\AvatarAbleInterface;
use App\Services\AbstractServices\BaseImageService;
use Illuminate\Http\UploadedFile;
use Route;

class AvatarService extends BaseImageService
{
    public static function routes(): void
    {
        Route::prefix('avatar')->group(function () {
            Route::get('/', 'AvatarController@show');
            Route::post('/', 'AvatarController@upload');
            Route::delete('/', 'AvatarController@delete');
        });
    }

    public function upload(AvatarAbleInterface $avatarAble, UploadedFile $avatarFile): Image
    {
        if ($avatarAble->avatar()->exists()) {
            $this->delete($avatarAble->avatar);
        }

        $fileName = $avatarFile->getClientOriginalName();
        $filePath = $this->basePath . '/avatars';

        $avatarPath = $this->storeImage($filePath, $avatarFile, $fileName);

        return $avatarAble->avatar()->updateOrCreate([], $this->getImageFields($avatarPath));
    }
}
