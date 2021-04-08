<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class PasswordResetMail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    private string $resetUrl;

    /**
     * Create a new message instance.
     *
     * @param string $resetUrl
     */
    public function __construct(string $resetUrl)
    {
        $this->resetUrl = $resetUrl;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build(): self
    {
        return $this->view('letters.reset_password')->with(['reset_url' => $this->resetUrl]);
    }
}
