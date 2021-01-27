<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ContactForm extends Mailable
{
    use Queueable, SerializesModels;
    protected $contactForm;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($contactForm)
    {
        $this->contactForm = $contactForm;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.contactform')
            ->with([
                'name' => $this->contactForm->name,
                'email' => $this->contactForm->email,
                'subject' => $this->contactForm->subject,
                'message' => $this->contactForm->message
            ]);
    }
}
