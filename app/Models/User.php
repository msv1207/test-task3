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
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

/**
 * @property int id
 * @property string name
 * @property string email
 */
class User extends Authenticatable implements
    LoginAbleInterface,
    PasswordResetableInterface,
    EmailConfirmableInterface,
    AvatarAbleInterface
{
    use HasFactory,
        Notifiable,
        LoginAble,
        PasswordResetable,
        EmailConfirmable,
        HasAvatar;

    public const AUTH_GUARD = 'users';

    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
