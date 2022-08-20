<?php

declare(strict_types=1);

namespace App\Security\UserInterface\AskNewPassword;

use Illuminate\Mail\Mailable;

class AskNewPasswordMail extends Mailable
{
    public function build(): Mailable
    {
        return $this->view('security.mails.new-password');
    }
}
