<?php

namespace App\Services;

use App\Exceptions\Auth\AuthFailedException;
use App\Models\Interfaces\LoginAbleInterface;
use Hash;
use Route;

class AuthService
{
    public static function routes(
        string $guard,
        bool $canRegister = true,
        bool $canResetPassword = true
    ): void
    {
        $throttle = config("auth.guards.{$guard}.throttle", 60);

        Route::prefix('auth')->namespace('Auth')->group(function () use (
            $guard,
            $canRegister,
            $canResetPassword,
            $throttle
        ) {
            Route::middleware("throttle:{$throttle}")->group(function () use ($canRegister) {
                Route::post('login', 'LoginController@login');

                if ($canRegister) Route::post('register', 'RegisterController');
            });

            Route::post('logout', 'LoginController@logout')->middleware("auth:{$guard}");

            if ($canResetPassword) PasswordResetService::routes($guard);
        });
    }

    public function getLoginAbleUser(string $loginAbleType, string $email, string $password): LoginAbleInterface
    {
        /** @var LoginAbleInterface $loginAble */
        $loginAble = $loginAbleType::whereEmail($email)->first();

        if (!$loginAble || !Hash::check($password, $loginAble->password)) {
            throw new AuthFailedException;
        }

        return $loginAble;
    }

    public function loginUser(LoginAbleInterface $loginAble, ?bool $rememberMe = false): string
    {
        $auth = auth($loginAble->getAuthGuard());
        if ($rememberMe) {
            $auth->setTTL(config('jwt.refresh_ttl'));
        }

        return $auth->login($loginAble);
    }

    public function logoutUser(string $guard): void
    {
        auth($guard)->logout();
    }
}
