<?php

declare(strict_types=1);

namespace App\Security\Domain\UseCases\Login;

use App\Security\Domain\Entities\User;
use App\Shared\UserInterface\Presenter;

interface LoginPresenter extends Presenter
{
    public function successfullyAuthenticatedUser(User $user): void;

    public function invalidCredentialsProvided(): void;
}
