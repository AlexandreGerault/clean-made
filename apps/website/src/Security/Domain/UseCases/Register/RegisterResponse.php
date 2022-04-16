<?php

declare(strict_types=1);

namespace App\Security\Domain\UseCases\Register;

use App\Security\Domain\Entities\User;

class RegisterResponse
{
    public function __construct(public readonly User $user)
    {
    }

    public function user(): User
    {
        return $this->user;
    }
}
