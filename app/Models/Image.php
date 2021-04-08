<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Support\Facades\Storage;

/**
 * @property int id
 *
 * @property string disk
 * @property string path
 * @property string url
 */
class Image extends Model
{
    use HasFactory;

    protected $fillable = [
        'imageable_id',
        'imageable_type',
        'disk',
        'path',
    ];


    /*
     * Relations
     */

    public function imageable(): MorphTo
    {
        return $this->morphTo();
    }


    /*
     * Attributes
     */

    public function getUrlAttribute(): string
    {
        return Storage::disk($this->disk)->url($this->path);
    }

}
