<?php

declare(strict_types=1);

namespace App\Security\Domain\UseCases\AskNewPassword;

use App\Security\Domain\Gateways\MailGateway;
use App\Security\Domain\Gateways\UserRepository;
use App\Security\Domain\Services\PasswordMail;
use App\Security\Domain\Services\ResetPasswordTokenGenerator;
use App\Security\Domain\ValueObjects\Email;

class AskNewPassword
{
    public function __construct(
        private readonly MailGateway $mailGateway,
        private readonly UserRepository $userRepository,
        private readonly PasswordMail $passwordMail,
        private readonly ResetPasswordTokenGenerator $resetPasswordTokenGenerator,
    ) {
    }

    public function executes(AskNewPasswordRequest $request, AskNewPasswordPresenter $presenter): void
    {
        try {
            $user = $this->userRepository->findByEmail(new Email($request->to));
        } catch (\Throwable $e) {
            $presenter->notificationSent();

            return;
        }

        $token = $this->resetPasswordTokenGenerator->generateTokenForUser($user);
        $user->changeResetPasswordToken($token);

        $this->userRepository->save($user);

        $this->mailGateway->send(
            new Email($request->to),
            $this->passwordMail->makeSubject(),
            $this->passwordMail->makeContent($user)
        );
        $presenter->notificationSent();
    }
}
