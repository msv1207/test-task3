<?php

namespace App\Models;

use App\Models\Interfaces\EmailConfirmableInterface;
use App\Models\Interfaces\LoginAbleInterface;
use App\Models\Interfaces\PasswordResetableInterface;
use App\Models\Traits\EmailConfirmable;
use App\Models\Traits\LoginAble;
use App\Models\Traits\PasswordResetable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

/**
 * @property int id
 *
 * @property string name
 * @property string email
 */
class Admin extends Authenticatable implements
    LoginAbleInterface,
    PasswordResetableInterface,
    EmailConfirmableInterface
{
    use HasFactory, LoginAble, PasswordResetable, EmailConfirmable;

    public const AUTH_GUARD = 'admins';

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
