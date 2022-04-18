<?php

declare(strict_types=1);

namespace Tests\Domain\Security\Login;

use App\Security\Domain\Services\CredentialsAuthenticator;

class InvalidCredentialsAuthenticator implements CredentialsAuthenticator
{
    public function authenticate(string $username, string $password): bool
    {
        return false;
    }
}
