<?php

declare(strict_types=1);

namespace Tests\Domain\Security\Login;

use App\Security\Domain\Entities\User;
use App\Security\Domain\Services\CredentialsAuthenticator;
use App\Security\Domain\ValueObjects\Email;
use App\Security\Domain\ValueObjects\HashedPassword;
use Ramsey\Uuid\Uuid;

class ValidCredentialsAuthenticator implements CredentialsAuthenticator
{
    public function authenticate(string $email, string $password): User|false
    {
        return new User(Uuid::uuid4(), new Email('john-doe@email'), new HashedPassword('password'));
    }
}
