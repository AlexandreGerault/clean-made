<?php

declare(strict_types=1);

namespace App\Security\Domain\ValueObjects;

class ResetPasswordToken
{
    public function __construct(public readonly string $value)
    {
    }
}
