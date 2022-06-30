<?php

namespace App\Core;

use App\Mail\ConfirmedRegistrationMail;
use Illuminate\Support\Facades\Mail;

class AuthorizationMailer
{
    public function sendAuthorizationMessage($email, $password)
    {
        $details = [
            'email' => $email,
            'password' => $password
        ];
        Mail::to($email)->send(new ConfirmedRegistrationMail($details));
    }
}
