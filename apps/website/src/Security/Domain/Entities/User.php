<?php

declare(strict_types=1);

namespace App\Security\Domain\Entities;

use App\Security\Domain\ValueObjects\Email;

class User
{
    public function __construct(private Email $email)
    {
    }

    public function snapshot(): UserSnapshot
    {
        return new UserSnapshot($this->email);
    }
}
