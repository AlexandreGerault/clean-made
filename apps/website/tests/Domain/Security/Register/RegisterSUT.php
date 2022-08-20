<?php

declare(strict_types=1);

namespace Tests\Domain\Security\Register;

use App\Security\Domain\UseCases\Register\Register;
use App\Security\Domain\UseCases\Register\RegisterRequest;
use Tests\Domain\Security\Adapters\InMemoryUserRepository;

class RegisterSUT
{
    public RegisterRequest $request;
    public RegisterTestPresenter $presenter;
    public Register $useCase;
    public InMemoryUserRepository $userRepository;

    public static function new(): RegisterSUT
    {
        $sut = new self();

        $sut->request = new RegisterRequest(
            'John Doe',
            'john-doe@email',
            'password'
        );
        $sut->presenter = new RegisterTestPresenter();
        $sut->userRepository ??= new InMemoryUserRepository();

        return $sut;
    }

    public function build(): RegisterSUT
    {
        $this->useCase = new Register($this->userRepository, new DummyPasswordHasher());

        return $this;
    }

    public function run(): RegisterSUT
    {
        $this->useCase->executes($this->presenter, $this->request);

        return $this;
    }

    public function emailAlreadyInUse(): self
    {
        $this->userRepository->forceUserExists();

        return $this;
    }
}
