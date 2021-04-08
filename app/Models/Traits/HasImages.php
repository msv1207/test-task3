<?php

namespace App\Models\Traits;

use App\Models\Image;
use Illuminate\Database\Eloquent\Relations\MorphMany;

trait HasImages
{
    public function getModelIdentifier(): string
    {
        return (string)$this->id;
    }

    public function getMaxCountOfImages(): int
    {
        return 5;
    }


    /*
     * Relations
     */

    public function images(): MorphMany
    {
        return $this->morphMany(Image::class, 'imageable');
    }
}
