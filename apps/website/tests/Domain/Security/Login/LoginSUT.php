<?php

declare(strict_types=1);

namespace Tests\Domain\Security\Login;

use App\Security\Domain\Gateways\UserRepository;
use App\Security\Domain\Services\CredentialsAuthenticator;
use App\Security\Domain\UseCases\Login\Login;
use App\Security\Domain\UseCases\Login\LoginRequest;

class LoginSUT
{
    public LoginRequest $request;
    public LoginTestPresenter $presenter;
    public Login $useCase;
    public CredentialsAuthenticator $authenticator;

    public static function new(): LoginSUT
    {
        return new self();
    }

    public function build(): LoginSUT
    {
        $this->presenter = new LoginTestPresenter();
        $this->request ??= new LoginRequest("John Doe", "password");
        $this->authenticator ??= new ValidCredentialsAuthenticator();

        $this->useCase = new Login($this->authenticator);

        return $this;
    }

    public function run(): LoginSUT
    {
        $this->useCase->executes($this->presenter, $this->request);

        return $this;
    }

    public function withInvalidCredentials(): LoginSUT
    {
        $this->authenticator = new InvalidCredentialsAuthenticator();

        return $this;
    }
}
