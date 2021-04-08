<?php

namespace App\Services;

use App\Models\Image;
use App\Models\Interfaces\ImageAbleInterface;
use App\Services\AbstractServices\BaseImageService;
use Illuminate\Http\UploadedFile;

class ImageService extends BaseImageService
{
    public function upload(ImageAbleInterface $imageAble, UploadedFile $image): Image
    {
        if ($imageAble->image()->exists()) {
            $this->delete($imageAble->image);
        }

        $fileName = $image->getClientOriginalName();
        $filePath = $this->getFilePath($imageAble);

        $imagePath = $this->storeImage($filePath, $image, $fileName);

        return $imageAble->image()->updateOrCreate([], $this->getImageFields($imagePath));
    }
}
