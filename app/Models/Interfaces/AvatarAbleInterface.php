<?php

namespace App\Models\Interfaces;

use App\Models\Image;
use Illuminate\Database\Eloquent\Relations\MorphOne;

/**
 * @property Image avatar
 * @property ?string avatar_url
 */
interface AvatarAbleInterface
{
    public function avatar(): MorphOne;

    public function getAvatarUrlAttribute(): ?string;
}
