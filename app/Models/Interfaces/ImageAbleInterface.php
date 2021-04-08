<?php

namespace App\Models\Interfaces;

use App\Models\Image;
use Illuminate\Database\Eloquent\Relations\MorphOne;

/**
 * @property Image image
 * @property ?string image_url
 */
interface ImageAbleInterface
{
    public function image(): MorphOne;

    public function getImageUrlAttribute(): ?string;

    public function getModelIdentifier(): string;

    public function getImagesFolderName(): string;
}
