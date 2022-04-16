<?php

declare(strict_types=1);

namespace App\Security\Domain\ValueObjects;

class Email
{
    public function __construct(public readonly string $value)
    {
    }

    public function equals(Email $email): bool
    {
        return $email->value === $this->value;
    }
}
