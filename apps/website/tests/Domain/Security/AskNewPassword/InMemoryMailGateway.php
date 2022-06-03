<?php

declare(strict_types=1);

namespace Tests\Domain\Security\AskNewPassword;

use App\Security\Domain\Gateways\MailGateway;
use App\Security\Domain\ValueObjects\Email;
use App\Security\Domain\ValueObjects\MailMessage;

class InMemoryMailGateway implements MailGateway
{
    public bool $sent = false;
    public MailMessage $lastEmail;

    public function send(Email $to, string $subject, string $body): void
    {
        $this->sent = true;
        $this->lastEmail = new MailMessage(
            $to,
            $subject,
            $body
        );
    }
}
