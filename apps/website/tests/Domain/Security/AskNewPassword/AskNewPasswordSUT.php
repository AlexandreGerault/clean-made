<?php

declare(strict_types=1);

namespace Tests\Domain\Security\AskNewPassword;

use App\Security\Domain\UseCases\AskNewPassword\AskNewPassword;
use App\Security\Domain\UseCases\AskNewPassword\AskNewPasswordRequest;
use Tests\Domain\Security\Register\InMemoryUserRepository;

class AskNewPasswordSUT
{
    public AskNewPassword $askNewPassword;
    public InMemoryMailGateway $mailGateway;
    public InMemoryUserRepository $userRepository;
    public DummyPasswordMail $dummyPasswordMail;
    public AskNewPasswordTestPresenter $presenter;

    public function __construct()
    {
        $this->mailGateway = new InMemoryMailGateway();

        $this->userRepository = new InMemoryUserRepository();
        $this->userRepository->forceUserExists();

        $this->dummyPasswordMail = new DummyPasswordMail();

        $this->presenter = new AskNewPasswordTestPresenter();
    }

    public function run(): self
    {
        $askNewPassword = new AskNewPassword($this->mailGateway, $this->userRepository, $this->dummyPasswordMail);
        $askNewPassword->executes(new AskNewPasswordRequest('user@email.fr'), $this->presenter);

        return $this;
    }

    public function whenEmailDoesNotMatchAnyUser(): static
    {
        $this->userRepository->forceUserDoesNotExist();

        return $this;
    }
}
