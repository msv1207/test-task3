<?php

namespace App\Observers;

use App\Models\PasswordReset;
use App\Services\PasswordResetService;

class PasswordResetObserver
{
    private PasswordResetService $passwordResetService;

    public function __construct(PasswordResetService $passwordResetService)
    {
        $this->passwordResetService = $passwordResetService;
    }

    /**
     * Handle the ProviderData "created" event.
     *
     * @param PasswordReset $passwordReset
     * @return void
     */
    public function created(PasswordReset $passwordReset): void
    {
        $this->passwordResetService->sendResetEmail($passwordReset);
    }

    /**
     * Handle the ProviderData "updated" event.
     *
     * @param PasswordReset $passwordReset
     * @return void
     */
    public function updated(PasswordReset $passwordReset): void
    {
        $this->passwordResetService->sendResetEmail($passwordReset);
    }

    /**
     * Handle the ProviderData "deleted" event.
     *
     * @param PasswordReset $passwordReset
     * @return void
     */
    public function deleted(PasswordReset $passwordReset): void
    {
        //
    }

    /**
     * Handle the ProviderData "restored" event.
     *
     * @param PasswordReset $passwordReset
     * @return void
     */
    public function restored(PasswordReset $passwordReset): void
    {
        //
    }

    /**
     * Handle the ProviderData "force deleted" event.
     *
     * @param PasswordReset $passwordReset
     * @return void
     */
    public function forceDeleted(PasswordReset $passwordReset): void
    {
        //
    }
}
