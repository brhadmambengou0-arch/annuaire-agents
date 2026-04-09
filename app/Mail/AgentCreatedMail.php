<?php

namespace App\Mail;

use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class AgentCreatedMail extends Mailable
{
    use SerializesModels;

    public $user;
    public $password;

    // 🔹 constructeur
    public function __construct($user, $password)
    {
        $this->user = $user;
        $this->password = $password;
    }

    // 🔹 construction du mail
    public function build()
    {
        return $this->subject('Vos accès ')
                    ->view('emails.agent-created');
    }
}