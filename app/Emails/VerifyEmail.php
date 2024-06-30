<?php

namespace App\Emails;
use Illuminate\Mail\Mailable;

class VerifyEmail extends Mailable
{
    public $email;
    private $hashcode;

    public function __construct($email, $hashcode)
    {
        $this->email = $email;
        $this->hashcode = $hashcode;
    }

    public function build()
    {
        return $this->view('emails.verify')
            ->with(['email' => $this->email,
                'hashcode' => $this->hashcode]);
    }
}
