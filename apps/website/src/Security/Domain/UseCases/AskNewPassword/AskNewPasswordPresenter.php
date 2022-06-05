<?php

declare(strict_types=1);

namespace App\Security\Domain\UseCases\AskNewPassword;

interface AskNewPasswordPresenter
{
    public function notificationSent(): void;
}
