<?php

declare(strict_types=1);

namespace App\Security\UserInterface\Register;

use App\Security\Domain\UseCases\Register\RegisterPresenter;
use App\Security\Domain\UseCases\Register\RegisterResponse;
use Symfony\Component\HttpFoundation\Response;

class HtmlRegisterPresenter implements RegisterPresenter
{
    private Response $response;

    public function userRegistered(RegisterResponse $response): void
    {
        $this->response = redirect()->back();
    }

    public function emailAlreadyInUse(): void
    {
        $this->response = redirect()->back()->withErrors(['emails' => "Cette adresse mail n'est pas disponible"]);
    }

    public function response(): Response
    {
        return $this->response;
    }
}
