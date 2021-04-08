<?php

namespace App\Models\Traits;

use Illuminate\Support\Facades\Storage;
use App\Models\Image;
use Illuminate\Database\Eloquent\Relations\MorphOne;

trait HasImage
{
    public function getModelIdentifier(): string
    {
        return (string)$this->id;
    }


    /*
     * Relations
     */

    public function image(): MorphOne
    {
        return $this->morphOne(Image::class, 'imageable');
    }


    /*
     * Attributes
     */

    public function getImageUrlAttribute(): ?string
    {
        if (!$this->image()->exists()) return null;

        return Storage::disk($this->disk)->url($this->image->path);
    }
}
