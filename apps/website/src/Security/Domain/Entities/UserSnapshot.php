<?php

declare(strict_types=1);

namespace App\Security\Domain\Entities;

use App\Security\Domain\ValueObjects\Email;
use App\Security\Domain\ValueObjects\HashedPassword;
use App\Security\Domain\ValueObjects\ResetPasswordToken;
use Ramsey\Uuid\UuidInterface;

class UserSnapshot
{
    public function __construct(
        public readonly UuidInterface $uuid,
        public readonly Email $email,
        public readonly HashedPassword $password,
        public readonly ?ResetPasswordToken $passwordToken = null,
    ) {
    }
}
