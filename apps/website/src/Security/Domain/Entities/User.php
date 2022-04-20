<?php

declare(strict_types=1);

namespace App\Security\Domain\Entities;

use App\Security\Domain\ValueObjects\Email;
use App\Security\Domain\ValueObjects\Password;

class User
{
    public function __construct(private Email $email, private Password $password)
    {
    }

    public function snapshot(): UserSnapshot
    {
        return new UserSnapshot($this->email, $this->password);
    }
}
