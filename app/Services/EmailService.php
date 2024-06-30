<?php

namespace App\Services;

use App\Emails\VerifyEmail;
use Illuminate\Support\Facades\Mail;

class EmailService
{
    public function sendVerificationEmail($email, $hashcode)
    {
        Mail::to($email)->send(new VerifyEmail(
            $email,
            rawurlencode($hashcode)
        ));
    }
}
