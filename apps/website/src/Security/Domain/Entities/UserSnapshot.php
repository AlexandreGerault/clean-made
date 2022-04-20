<?php

declare(strict_types=1);

namespace App\Security\Domain\Entities;

use App\Security\Domain\ValueObjects\Email;
use App\Security\Domain\ValueObjects\Password;

class UserSnapshot
{
    public function __construct(public readonly Email $email, public readonly Password $password)
    {
    }
}
