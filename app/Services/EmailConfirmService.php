<?php

namespace App\Services;

use App\Mail\EmailConfirmMail;
use App\Models\EmailConfirm;
use App\Models\Interfaces\EmailConfirmableInterface;
use Illuminate\Support\Str;
use Mail;
use Carbon\Carbon;

class EmailConfirmService
{
    public function createOrUpdate(EmailConfirmableInterface $emailConfirmable): EmailConfirm
    {
        $confirmToken = Str::random();

        return $emailConfirmable->emailConfirm()->updateOrCreate([], [
            'confirm_token' => encrypt($confirmToken),
        ]);
    }

    public function sendEmailToConfirm(EmailConfirm $emailConfirm)
    {
        $emailField = $emailConfirm->emailConfirmable->getEmailField();

        Mail::to($emailConfirm->emailConfirmable->$emailField)
            ->queue(new EmailConfirmMail($this->getConfirmUrl($emailConfirm)));
    }

    public function confirmEmail(EmailConfirm $emailConfirm, string $token): bool
    {
        if (!$this->checkTokenIfValid($emailConfirm, $token)) return false;

        $emailConfirmAble = $emailConfirm->emailConfirmable;
        $emailConfirmField = $emailConfirmAble->getEmailConfirmedAtField();

        $emailConfirmAble->$emailConfirmField = now();
        $emailConfirmAble->save();

        return $emailConfirm->delete();
    }

    public function checkTokenIfValid(EmailConfirm $emailConfirm, string $token): bool
    {
        return $token === decrypt($emailConfirm->confirm_token);
    }

    public function deleteExpiredEmailConfirms(string $emailConfirmableType): void
    {
        EmailConfirm::query()
            ->where('email_confirmable_type', $emailConfirmableType)
            ->where('created_at', '<', Carbon::now()->subDay())
            ->delete();
    }


    private function getConfirmUrl(EmailConfirm $emailConfirm): string
    {
        $id = $emailConfirm->id;
        $token = decrypt($emailConfirm->confirm_token);

        return url("email_confirm/{$id}/{$token}");
    }
}
