<?php

declare(strict_types=1);

namespace App\Security\Domain\UseCases\Login;

class LoginRequest
{
    public function __construct(public readonly string $username, public readonly string $password)
    {
    }
}
