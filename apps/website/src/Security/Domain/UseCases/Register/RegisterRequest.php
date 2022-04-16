<?php

declare(strict_types=1);

namespace App\Security\Domain\UseCases\Register;

class RegisterRequest
{
    public function __construct(
        public readonly string $pseudonym,
        public readonly string $email,
        public readonly string $password
    ) {
    }
}
