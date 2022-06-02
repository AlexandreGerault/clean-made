<?php

declare(strict_types=1);

namespace App\Security\Infrastructure;

use App\Security\Domain\Services\PasswordHasher;
use App\Security\Domain\ValueObjects\HashedPassword;
use App\Security\Domain\ValueObjects\Password;
use Illuminate\Support\Facades\Hash;

class LaravelPasswordHasher implements PasswordHasher
{
    public function hash(Password $password): HashedPassword
    {
        return new HashedPassword(Hash::make($password->value));
    }
}
