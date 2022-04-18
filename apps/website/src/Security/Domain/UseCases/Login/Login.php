<?php

declare(strict_types=1);

namespace App\Security\Domain\UseCases\Login;

use App\Security\Domain\Entities\User;
use App\Security\Domain\Services\CredentialsAuthenticator;
use App\Security\Domain\ValueObjects\Email;

class Login
{
    public function __construct(private readonly CredentialsAuthenticator $authenticator)
    {
    }

    public function executes(LoginPresenter $presenter, LoginRequest $request): void
    {
        if (!$this->authenticator->authenticate($request->username, $request->password)) {
            $presenter->invalidCredentialsProvided();
        }

        $presenter->successfullyAuthenticatedUser(new User(new Email('john-doe@email')));
    }
}
