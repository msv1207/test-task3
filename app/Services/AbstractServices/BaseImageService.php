<?php

namespace App\Services\AbstractServices;

use App\Models\Interfaces\ImageAbleInterface;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Str;
use App\Models\Image;
use App\Models\Interfaces\BaseImageAbleInterface;
use Intervention\Image\Facades\Image as ImageTools;
use Intervention\Image\Image as PreparedImage;

abstract class BaseImageService extends StorageService
{
    public const FORMAT_JPG = 'jpg';
    public const FORMAT_JPEG = 'jpeg';
    public const FORMAT_PNG = 'png';
    public const FORMAT_GIF = 'gif';
    public const FORMAT_TIF = 'tif';
    public const FORMAT_BMP = 'bmp';
    public const FORMAT_SVG = 'svg';
    public const FORMAT_WEBP = 'webp';

    protected int $quality;
    protected ?string $format = null;

    public function __construct()
    {
        $this->setQuality(config('image.quality', 90));
    }

    public static function getFormats(): array
    {
        return [
            self::FORMAT_JPG,
            self::FORMAT_JPEG,
            self::FORMAT_PNG,
            self::FORMAT_GIF,
            self::FORMAT_TIF,
            self::FORMAT_BMP,
            self::FORMAT_SVG,
            self::FORMAT_WEBP,
        ];
    }

    public function setQuality(int $quantity): self
    {
        if ($quantity <= 0 || $quantity > 100) return $this;

        $this->quality = $quantity;

        return $this;
    }

    public function setFormat(string $format): self
    {
        if (!in_array($format, self::getFormats())) return $this;

        $this->format = $format;

        return $this;
    }

    public function delete(Image $image): bool
    {
        $this->setStorage($image->disk);
        if ($this->storage->exists($image->path)) {
            $this->storage->delete($image->path);
        }

        return $image->delete();
    }


    protected function getFilePath(ImageAbleInterface $imageAble): string
    {
        $folderName = $imageAble->getImagesFolderName();
        $modelIdentifier = $imageAble->getModelIdentifier();

        return "{$this->basePath}/{$folderName}/{$modelIdentifier}";
    }

    protected function getImageFields(string $imagePath): array
    {
        return [
            'disk' => $this->diskName,
            'path' => $imagePath,
        ];
    }


    protected function storeImage(string $filePath, UploadedFile $image, string $fileName = null): string
    {
        $fileName = $fileName ?? Str::random();

        $preparedImageFile = $this->prepareImageFile($image);

        return $this->storage->putFileAs($filePath, $preparedImageFile->basePath(), $fileName);
    }

    protected function prepareImageFile(UploadedFile $imageFile): PreparedImage
    {
        return ImageTools::make($imageFile)
            ->orientate()
            ->encode($this->format, $this->quality);
    }
}
