<?php

namespace App\Models;

use DateTime;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int id
 *
 * @property int author_id
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
class Book extends Model
{
    use HasFactory;

    protected $fillable = [
        'author_id',
        'title',
        'short_description',
        'description',
    ];


    /*
     * Relations
     */

    public function author(): BelongsTo
    {
        return $this->belongsTo(Author::class);
    }

}
