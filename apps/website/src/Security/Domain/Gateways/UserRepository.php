<?php

declare(strict_types=1);

namespace App\Security\Domain\Gateways;

use App\Security\Domain\Entities\User;
use App\Security\Domain\ValueObjects\Email;

interface UserRepository
{
    public function exists(Email $email): bool;

    public function save(User $user): void;
}
