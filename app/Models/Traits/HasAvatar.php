<?php

namespace App\Models\Traits;

use Illuminate\Support\Facades\Storage;
use App\Models\Image;
use Illuminate\Database\Eloquent\Relations\MorphOne;

trait HasAvatar
{
    /*
     * Relations
     */

    public function avatar(): MorphOne
    {
        return $this->morphOne(Image::class, 'imageable');
    }


    /*
     * Attributes
     */

    public function getAvatarUrlAttribute(): ?string
    {
        if (!$this->avatar()->exists()) return null;

        return Storage::disk($this->avatar->disk)->url($this->avatar->path);
    }
}
