<?php

declare(strict_types=1);

namespace App\Security\Domain\Services;

interface CredentialsAuthenticator
{
    public function authenticate(string $username, string $password): bool;
}
