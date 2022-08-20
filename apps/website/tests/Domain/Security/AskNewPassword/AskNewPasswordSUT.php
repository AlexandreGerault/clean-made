<?php

declare(strict_types=1);

namespace Tests\Domain\Security\AskNewPassword;

use App\Security\Domain\Entities\User;
use App\Security\Domain\UseCases\AskNewPassword\AskNewPassword;
use App\Security\Domain\UseCases\AskNewPassword\AskNewPasswordRequest;
use App\Security\Domain\ValueObjects\Email;
use App\Security\Domain\ValueObjects\HashedPassword;
use Ramsey\Uuid\Uuid;
use Tests\Domain\Security\Adapters\InMemoryMailGateway;
use Tests\Domain\Security\Adapters\InMemoryUserRepository;

class AskNewPasswordSUT
{
    public AskNewPassword $askNewPassword;
    public InMemoryMailGateway $mailGateway;
    public InMemoryUserRepository $userRepository;
    public DummyPasswordMail $dummyPasswordMail;
    public AskNewPasswordTestPresenter $presenter;
    public FakeResetPasswordTokenGenerator $resetPasswordTokenGenerator;

    public function __construct()
    {
        $this->mailGateway = new InMemoryMailGateway();

        $this->userRepository = new InMemoryUserRepository([
            new User(Uuid::uuid4(), new Email('user@email.fr'), new HashedPassword('password')),
        ]);

        $this->dummyPasswordMail = new DummyPasswordMail();

        $this->presenter = new AskNewPasswordTestPresenter();

        $this->resetPasswordTokenGenerator = new FakeResetPasswordTokenGenerator();
    }

    public function run(): self
    {
        $askNewPassword = new AskNewPassword($this->mailGateway, $this->userRepository, $this->dummyPasswordMail, $this->resetPasswordTokenGenerator);
        $askNewPassword->executes(new AskNewPasswordRequest('user@email.fr'), $this->presenter);

        return $this;
    }

    public function whenEmailDoesNotMatchAnyUser(): static
    {
        $this->userRepository = new InMemoryUserRepository();

        return $this;
    }
}
