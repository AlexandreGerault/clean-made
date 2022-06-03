<?php

declare(strict_types=1);

namespace App\Security\Domain\Gateways;

use App\Security\Domain\ValueObjects\Email;

interface MailGateway
{
    public function send(Email $to, string $subject, string $body): void;
}
