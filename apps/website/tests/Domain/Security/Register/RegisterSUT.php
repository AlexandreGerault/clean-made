<?php

declare(strict_types=1);

namespace Tests\Domain\Security\Register;

use App\Security\Domain\Entities\User;
use App\Security\Domain\Gateways\UserRepository;
use App\Security\Domain\UseCases\Register\Register;
use App\Security\Domain\UseCases\Register\RegisterRequest;
use App\Security\Domain\ValueObjects\Email;

class RegisterSUT
{
    public RegisterRequest $request;
    public RegisterTestPresenter $presenter;
    public Register $useCase;
    public UserRepository $userRepository;

    public static function new(): RegisterSUT
    {
        return new self();
    }

    public function build(): RegisterSUT
    {
        $this->request = new RegisterRequest(
            "John Doe",
            "john-doe@email",
            "password"
        );
        $this->presenter = new RegisterTestPresenter();
        $this->userRepository ??= new InMemoryUserRepository();

        $this->useCase = new Register($this->userRepository);

        return $this;
    }

    public function run(): RegisterSUT
    {
        $this->useCase->executes($this->presenter, $this->request);

        return $this;
    }

    public function emailAlreadyInUse(): self
    {
        $request = $this->getRequest();
        $this->request = new RegisterRequest($request->pseudonym, "john-doe@email", $request->password);

        $user = new User(new Email("john-doe@email"));
        $this->userRepository = new InMemoryUserRepository([$user]);

        return $this;
    }

    private function getRequest(): RegisterRequest
    {
        return $this->request ?? new RegisterRequest("John Doe", "john-doe@email", "password");
    }
}
