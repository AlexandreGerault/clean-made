<?php

declare(strict_types=1);

namespace App\Security\Domain\ValueObjects;

class MailMessage
{
    public function __construct(
        public Email $to,
        public string $subject,
        public string $body,
    ) {
    }
}
