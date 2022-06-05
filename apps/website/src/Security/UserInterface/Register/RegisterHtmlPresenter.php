<?php

declare(strict_types=1);

namespace App\Security\UserInterface\Register;

use App\Security\Domain\Entities\User;
use App\Security\Domain\UseCases\Register\RegisterPresenter;
use Symfony\Component\HttpFoundation\Response;

class RegisterHtmlPresenter implements RegisterPresenter
{
    private Response $response;

    public function userRegistered(User $user): void
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
