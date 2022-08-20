<?php

declare(strict_types=1);

namespace App\Security\Domain\Entities;

use App\Security\Domain\ValueObjects\Email;
use App\Security\Domain\ValueObjects\HashedPassword;
use App\Security\Domain\ValueObjects\ResetPasswordToken;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;

class User
{
    private ?ResetPasswordToken $resetPasswordToken = null;

    public function __construct(
        private readonly UuidInterface $uuid,
        private readonly Email $email,
        private readonly HashedPassword $password
    ) {
    }

    public static function create(string $email, string $password): User
    {
        return new self(Uuid::uuid4(), new Email($email), new HashedPassword($password));
    }

    public function snapshot(): UserSnapshot
    {
        return new UserSnapshot($this->uuid, $this->email, $this->password, $this->resetPasswordToken);
    }

    public function changeResetPasswordToken(ResetPasswordToken $token): void
    {
        $this->resetPasswordToken = $token;
    }
}
