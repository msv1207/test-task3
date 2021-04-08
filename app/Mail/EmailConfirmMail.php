<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class EmailConfirmMail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    private string $confirmUrl;

    /**
     * Create a new message instance.
     *
     * @param string $confirmUrl
     */
    public function __construct(string $confirmUrl)
    {
        $this->confirmUrl = $confirmUrl;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build(): self
    {
        return $this->view('letters.email_confirm')->with(['confirm_url' => $this->confirmUrl]);
    }
}
