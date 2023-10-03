<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Queue\SerializesModels;

class ContactFormSubmissionMail extends Mailable
{
    use Queueable, SerializesModels;

    public $name;
    public $email;
    public $message;
    public $discord;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($name, $email, $message, $discord = '')
    {
        $this->name = $name;
        $this->email = $email;
        $this->message = $message;
        $this->discord = $discord;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('mail.contact-form')
            ->subject($this->discord ? 'Job Application submission' : 'Contact form submission')
            ->with([
                'name' => $this->name,
                'email' => $this->email,
                'message' => $this->message,
                'discord' => $this->discord,
                'receiver' => $this->discord ? config('eloking.contact_form_submission_receiver_email') : $this->email,
            ]);
    }
}
