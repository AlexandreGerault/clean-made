<?php

declare(strict_types=1);

namespace Tests\Domain\Security\Login;

use App\Security\Domain\Entities\User;
use App\Security\Domain\UseCases\Login\LoginPresenter;
use App\Security\Domain\UseCases\Login\LoginResponse;
use App\Shared\UserInterface\ViewModel;
use Exception;

class LoginTestPresenter implements LoginPresenter
{
    private LoginResponse $response;

    public function response(): LoginResponse
    {
        return $this->response;
    }

    public function successfullyAuthenticatedUser(User $user): void
    {
        $this->response = new LoginResponse($user);
    }

    /**
     * @throws Exception
     */
    public function invalidCredentialsProvided(): void
    {
        throw new Exception('Invalid credentials provided');
    }

    public function viewModel(): ViewModel
    {
        return new class implements ViewModel {};
    }
}
