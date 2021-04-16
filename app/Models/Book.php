<?php

namespace App\Models;

use App\Models\Interfaces\ImageAbleInterface;
use App\Models\Traits\HasImage;
use DateTime;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int id
 *
 * @property int author_id
 *
 * @property string status
 *
 * @property string title
 * @property string short_description
 * @property string description
 *
 * @property DateTime created_at
 * @property DateTime updated_at
 *
 * @property Author author
 */
class Book extends Model implements ImageAbleInterface
{
    use HasFactory, HasImage;

    public const STATUS_ACTIVE = 'active';
    public const STATUS_BLOCKED = 'blocked';

    protected $fillable = [
        'author_id',
        'title',
        'short_description',
        'description',
        'status',
    ];

    public function getImagesFolderName(): string
    {
        return 'books';
    }

    /*
     * Relations
     */

    public function author(): BelongsTo
    {
        return $this->belongsTo(Author::class);
    }


    /*
     * Scopes
     */

    public function scopeActive(Builder $query): Builder
    {
        return $query->whereStatus(self::STATUS_ACTIVE);
    }
}
