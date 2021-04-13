<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class Confirmation extends Mailable
{
    use Queueable, SerializesModels;

    private $contactPerson;
    private $project;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($contactPerson, $project)
    {
        $this->contactPerson = $contactPerson;
        $this->project = $project;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this
            ->from(\Config::get('mail.sender'))
            ->view('frontend.mail.confirmation')
            ->with('contactPerson', $this->contactPerson)
            ->with('project', $this->project);
    }
}
