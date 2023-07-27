<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ForgotPassword extends Mailable
{
    use Queueable, SerializesModels;

    protected $username;
    protected $email;
    protected $token;
    protected $operating_system;
    protected $browser;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($username, $email, $token, $operating_system, $browser)
    {
        $this->username = $username;
        $this->email = $email;
        $this->token = $token;
        $this->operating_system = $operating_system;
        $this->browser = $browser;
    }   

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('anilifevet@gmail.com')
            ->markdown('email.forgot-password')
            ->with([
                'username'          => $this->username,
                'email'             => $this->email,
                'token'             => $this->token,
                'operating_system'  => $this->operating_system,
                'browser'           => $this->browser,
            ])
            ->subject("Anilife - Reset Password Link");
    }
}
