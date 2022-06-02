<?php

declare(strict_types=1);

namespace App\Security\Domain\Services;

use App\Security\Domain\ValueObjects\HashedPassword;
use App\Security\Domain\ValueObjects\Password;

interface PasswordHasher
{
    public function hash(Password $password): HashedPassword;
}
