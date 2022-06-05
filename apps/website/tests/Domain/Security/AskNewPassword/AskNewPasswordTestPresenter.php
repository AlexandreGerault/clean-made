<?php

declare(strict_types=1);

namespace Tests\Domain\Security\AskNewPassword;

use App\Security\Domain\UseCases\AskNewPassword\AskNewPasswordPresenter;

class AskNewPasswordTestPresenter implements AskNewPasswordPresenter
{
    public string $response;

    public function notificationSent(): void
    {
        $this->response = 'notificationSent';
    }
}
