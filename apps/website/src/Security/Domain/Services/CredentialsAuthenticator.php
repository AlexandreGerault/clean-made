<?php

declare(strict_types=1);

namespace App\Security\Domain\Services;

use App\Security\Domain\Entities\User;

interface CredentialsAuthenticator
{
    public function authenticate(string $email, string $password): User|false;
}
