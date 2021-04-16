<?php

namespace App\Models;

use App\Models\Interfaces\AvatarAbleInterface;
use App\Models\Interfaces\EmailConfirmableInterface;
use App\Models\Interfaces\LoginAbleInterface;
use App\Models\Interfaces\PasswordResetableInterface;
use App\Models\Traits\EmailConfirmable;
use App\Models\Traits\HasAvatar;
use App\Models\Traits\LoginAble;
use App\Models\Traits\PasswordResetable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;

/**
 * @property int id
 *
 * @property string status
 *
 * @property string name
 * @property string email
 */
class Author extends Authenticatable implements
    LoginAbleInterface,
    PasswordResetableInterface,
    EmailConfirmableInterface,
    AvatarAbleInterface
{
    use HasFactory,
        LoginAble,
        PasswordResetable,
        EmailConfirmable,
        HasAvatar;

    public const AUTH_GUARD = 'authors';

    public const STATUS_ACTIVE = 'active';
    public const STATUS_BLOCKED = 'blocked';

    protected $fillable = [
        'name',
        'email',
        'password',
        'status',
    ];

    protected $hidden = [
        'password',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    /*
     * Relations
     */

    public function books(): HasMany
    {
        return $this->hasMany(Book::class);
    }


    /*
     * Scopes
     */

    public function scopeActive(Builder $query): Builder
    {
        return $query->whereStatus(self::STATUS_ACTIVE);
    }
}
