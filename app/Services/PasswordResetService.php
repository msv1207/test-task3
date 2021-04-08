<?php

namespace App\Services;

use App\Mail\PasswordResetMail;
use App\Models\Interfaces\PasswordResetableInterface;
use App\Models\PasswordReset;
use Carbon\Carbon;
use Hash;
use Illuminate\Support\Str;
use Mail;
use Route;

class PasswordResetService
{
    public static function routes(string $guard): void
    {
        $throttle = config("auth.providers.{$guard}.throttle", 60);

        Route::prefix('password')->group(function () use ($throttle, $guard) {
            Route::post('send', 'ForgotPasswordController@sendResetEmail');

            Route::middleware("throttle:{$throttle}")->group(function () {
                Route::put('{password_reset:id}/reset', 'ForgotPasswordController@resetPassword');
            });
        });
    }


    public function createPasswordReset(PasswordResetableInterface $user): array
    {
        $resetToken = Str::random();
        $passwordReset = $this->createOrUpdatePasswordReset($user, $resetToken);

        return [
            'id'          => $passwordReset->id,
            'reset_token' => $resetToken,
        ];
    }

    public function sendResetEmail(PasswordReset $passwordReset): void
    {
        $emailField = $passwordReset->resetable->getEmailField();

        Mail::to($passwordReset->resetable->$emailField)
            ->queue(new PasswordResetMail($this->getResetUrl($passwordReset)));
    }

    public function checkResetToken(PasswordReset $passwordReset, string $resetToken): bool
    {
        return $resetToken === decrypt($passwordReset->reset_token);
    }

    public function resetPassword(PasswordReset $passwordReset, array $data): void
    {
        $passwordReset->resetable()->update([
            'password' => Hash::make($data['password']),
        ]);

        $passwordReset->delete();
    }

    public function deleteExpiredPasswordResets(string $resetableType): void
    {
        $timeToExpire = config('auth.passwords.' . $resetableType . '.expire', 60);

        PasswordReset::query()
            ->where('resetable_type', $resetableType)
            ->where('created_at', '<', Carbon::now()->subMinutes($timeToExpire))
            ->delete();
    }


    private function createOrUpdatePasswordReset(PasswordResetableInterface $user, string $resetToken): PasswordReset
    {
        return $user->passwordReset()->updateOrCreate([], [
            'reset_token' => encrypt($resetToken),
            'created_at'  => now(),
            'updated_at'  => now(),
        ]);
    }

    private function getResetUrl(PasswordReset $passwordReset): string
    {
        $id = $passwordReset->id;
        $token = decrypt($passwordReset->reset_token);

        return url("password_reset/{$id}/{$token}");
    }
}
