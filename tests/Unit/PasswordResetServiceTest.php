<?php

namespace Tests\Unit;

use App\Models\Interfaces\PasswordResetableInterface;
use App\Models\PasswordReset;
use App\Models\User;
use App\Services\PasswordResetService;
use Carbon\Carbon;
use Hash;
use Illuminate\Support\Str;
use Tests\TestCase;

class PasswordResetServiceTest extends TestCase
{
    private PasswordResetService $passwordResetService;

    public function __construct(?string $name = null, array $data = [], $dataName = '')
    {
        parent::__construct($name, $data, $dataName);

        $this->passwordResetService = resolve(PasswordResetService::class);
    }

    public function testCreatePasswordReset(): void
    {
        $user = User::factory()->create();
        $this->passwordResetService->createPasswordReset($user);

        $this->assertDatabaseHas('password_resets', [
            'resetable_id'   => $user->id,
            'resetable_type' => User::class,
        ]);

        $this->assertEquals(PasswordReset::class, get_class($user->passwordReset));
    }

    public function testCheckResetToken(): void
    {
        $user = User::factory()->create();
        $passwordReset = $this->createPasswordReset($user);

        $resetToken = Str::random();
        $passwordReset->reset_token = encrypt($resetToken);
        $passwordReset->save();

        $this->assertTrue($this->passwordResetService->checkResetToken($passwordReset, $resetToken));
    }

    public function testResetPassword(): void
    {
        $user = User::factory()->create();
        $passwordReset = $this->createPasswordReset($user);

        $newPassword = 'NewPassword';

        $this->passwordResetService->resetPassword($passwordReset, ['password' => $newPassword]);

        $this->assertDatabaseMissing('password_resets', ['id' => $passwordReset->id]);
        $this->assertNull(PasswordReset::find($passwordReset->id));
        $this->assertTrue(Hash::check($newPassword, $user->refresh()->password));
    }

    public function testDeleteExpiredPasswordResets(): void
    {
        $user = User::factory()->create();
        $passwordReset = $this->createPasswordReset($user);

        $expireTime = config('auth.passwords.' . User::class . '.expire') + 1;
        $passwordReset->created_at = Carbon::now()->subMinutes($expireTime);
        $passwordReset->save();

        $this->passwordResetService->deleteExpiredPasswordResets(User::class);

        $this->assertDatabaseMissing('password_resets', ['id' => $passwordReset->id]);
        $this->assertNull(PasswordReset::find($passwordReset->id));
    }


    private function createPasswordReset(PasswordResetableInterface $resetable): PasswordReset
    {
        $this->passwordResetService->createPasswordReset($resetable);

        $resetable->loadMissing('passwordReset');

        return $resetable->passwordReset;
    }
}
