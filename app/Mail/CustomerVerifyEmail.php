<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class CustomerVerifyEmail extends Mailable
{
    use Queueable, SerializesModels;

    protected $username;
    protected $email;
    protected $token;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($username, $email, $token)
    {
        $this->username = $username;
        $this->email = $email;
        $this->token = $token;
    }   

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('anilifevet@gmail.com')
            ->markdown('email.customer-verify-email')
            ->with([
                'username'          => $this->username,
                'email'             => $this->email,
                'token'             => $this->token,
            ])
            ->subject("Anilife - Verify Email (Registration)");
    }
}
