<?php

declare(strict_types=1);

namespace Tests\Domain\Security\Register;

use App\Security\Domain\Services\PasswordHasher;
use App\Security\Domain\ValueObjects\HashedPassword;
use App\Security\Domain\ValueObjects\Password;

class DummyPasswordHasher implements PasswordHasher
{
    public function hash(Password $password): HashedPassword
    {
        return new HashedPassword($password->value);
    }
}
