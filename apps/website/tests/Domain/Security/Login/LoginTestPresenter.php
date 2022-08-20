<?php

declare(strict_types=1);

namespace Tests\Domain\Security\Login;

use App\Security\Domain\Entities\User;
use App\Security\Domain\UseCases\Login\LoginPresenter;
use Exception;

class LoginTestPresenter implements LoginPresenter
{
    private string $response;

    public function response(): string
    {
        return $this->response;
    }

    public function successfullyAuthenticatedUser(User $user): void
    {
        $this->response = 'Successfully authenticated user';
    }

    /**
     * @throws Exception
     */
    public function invalidCredentialsProvided(): void
    {
        $this->response = 'Invalid credentials provided';
    }
}
