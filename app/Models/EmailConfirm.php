<?php

namespace App\Models;

use App\Models\Interfaces\EmailConfirmableInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

/**
 * @property int id
 *
 * @property string confirm_token
 * @property string email_confirmable_type
 *
 * @property EmailConfirmableInterface emailConfirmable
 */
class EmailConfirm extends Model
{
    protected $fillable = [
        'email_confirmable_id',
        'email_confirmable_type',
        'confirm_token',
    ];


    /*
     * Relations
     */

    public function emailConfirmable(): MorphTo
    {
        return $this->morphTo('email_confirmable');
    }
}
