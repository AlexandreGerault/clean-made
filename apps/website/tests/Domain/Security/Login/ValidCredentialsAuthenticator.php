<?php

declare(strict_types=1);

namespace Tests\Domain\Security\Login;

use App\Security\Domain\Entities\User;
use App\Security\Domain\Services\CredentialsAuthenticator;
use App\Security\Domain\ValueObjects\Email;
use App\Security\Domain\ValueObjects\HashedPassword;

class ValidCredentialsAuthenticator implements CredentialsAuthenticator
{
    public function authenticate(string $username, string $password): User|false
    {
        return new User(new Email('john-doe@email'), new HashedPassword('password'));
    }
}
