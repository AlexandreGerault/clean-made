<?php

declare(strict_types=1);

namespace App\Security\Domain\UseCases\Login;

use App\Security\Domain\Entities\User;

interface LoginPresenter
{
    public function successfullyAuthenticatedUser(User $user): void;

    public function invalidCredentialsProvided(): void;
}
