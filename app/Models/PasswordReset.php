<?php

namespace App\Models;

use App\Models\Interfaces\PasswordResetableInterface;
use DateTime;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

/**
 * @property int id
 *
 * @property int resetable_id
 * @property string resetable_type
 *
 * @property string reset_token
 *
 * @property PasswordResetableInterface resetable
 *
 * @property DateTime created_at
 * @property DateTime updated_at
 */
class PasswordReset extends Model
{
    use HasFactory;

    protected $fillable = [
        'resetable_id',
        'resetable_type',
        'reset_token',
    ];


    /*
     * Relations
     */

    public function resetable(): MorphTo
    {
        return $this->morphTo();
    }
}
