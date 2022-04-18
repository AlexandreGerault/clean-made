<?php

declare(strict_types=1);

namespace App\Security\Domain\UseCases\Login;

use App\Security\Domain\Entities\User;

class LoginResponse
{
    public function __construct(private readonly User $user)
    {
    }

    public function user(): User
    {
        return $this->user;
    }
}
