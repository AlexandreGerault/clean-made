<?php

declare(strict_types=1);

namespace App\Security\Domain\UseCases\Login;

use App\Security\Domain\Services\CredentialsAuthenticator;

class Login
{
    public function __construct(private readonly CredentialsAuthenticator $authenticator)
    {
    }

    public function executes(LoginPresenter $presenter, LoginRequest $request): void
    {
        $user = $this->authenticator->authenticate($request->username, $request->password);

        if (!$user) {
            $presenter->invalidCredentialsProvided();

            return;
        }

        $presenter->successfullyAuthenticatedUser($user);
    }
}
