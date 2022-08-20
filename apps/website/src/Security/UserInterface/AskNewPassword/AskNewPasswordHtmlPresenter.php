<?php

declare(strict_types=1);

namespace App\Security\UserInterface\AskNewPassword;

use App\Security\Domain\UseCases\AskNewPassword\AskNewPasswordPresenter;
use Symfony\Component\HttpFoundation\Response;

class AskNewPasswordHtmlPresenter implements AskNewPasswordPresenter
{
    private Response $response;

    public function notificationSent(): void
    {
        $this->response = response()->noContent();
    }

    public function response(): Response
    {
        return $this->response;
    }
}
