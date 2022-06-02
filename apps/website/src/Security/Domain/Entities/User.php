<?php

declare(strict_types=1);

namespace App\Security\Domain\Entities;

use App\Security\Domain\ValueObjects\Email;
use App\Security\Domain\ValueObjects\HashedPassword;

class User
{
    public function __construct(private readonly Email $email, private readonly HashedPassword $password)
    {
    }

    public static function create(string $email, string $password): User
    {
        return new self(new Email($email), new HashedPassword($password));
    }

    public function snapshot(): UserSnapshot
    {
        return new UserSnapshot($this->email, $this->password);
    }
}
