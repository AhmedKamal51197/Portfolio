<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ResetEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $token;

    /**
     * Create a new message instance.
     *
     * @param  mixed  $user
     * @param  string  $url
     * @return void
     */
    public function __construct($user, $token)
    {
        $this->user = $user;
        $this->token = $token;
       // dd($url);

        // Set the sender email address and subject
        $this->from('sonbaty1937@gmail.com', 'Rouida');
        $this->subject('Change password Email');
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        // Use a predefined view for the email content
        return $this->view('emails.reset_email');
    }
}
