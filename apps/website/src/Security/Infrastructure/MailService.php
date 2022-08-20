<?php

declare(strict_types=1);

namespace App\Security\Infrastructure;

use App\Security\Domain\Gateways\MailGateway;
use App\Security\Domain\ValueObjects\Email;
use Illuminate\Mail\Mailable;
use Illuminate\Support\Facades\Mail;

class MailService implements MailGateway
{
    public function send(Email $to, string $subject, string $body): void
    {
        Mail::to($to->value)->send((new Mailable())->subject($subject)->html($body));
    }
}
