<?php

declare(strict_types=1);

namespace App\Security\Domain\UseCases\Register;

use App\Security\Domain\Entities\User;
use App\Security\Domain\Gateways\UserRepository;
use App\Security\Domain\Services\PasswordHasher;
use App\Security\Domain\ValueObjects\Email;
use App\Security\Domain\ValueObjects\Password;

class Register
{
    public function __construct(
        private readonly UserRepository $userRepository,
        private readonly PasswordHasher $hasher
    ) {
    }

    public function executes(RegisterPresenter $presenter, RegisterRequest $request): void
    {
        if ($this->userRepository->exists(new Email($request->email))) {
            $presenter->emailAlreadyInUse();

            return;
        }

        $hashedPassword = $this->hasher->hash(new Password($request->password));

        $user = new User(new Email($request->email), $hashedPassword);
        $this->userRepository->save($user);
        $presenter->userRegistered(new RegisterResponse($user));
    }
}
