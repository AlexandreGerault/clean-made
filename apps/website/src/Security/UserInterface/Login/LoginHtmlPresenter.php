<?php

declare(strict_types=1);

namespace App\Security\UserInterface\Login;

use App\Security\Domain\Entities\User;
use App\Security\Domain\UseCases\Login\LoginPresenter;
use Symfony\Component\HttpFoundation\Response;

class LoginHtmlPresenter implements LoginPresenter
{
    private Response $response;

    public function successfullyAuthenticatedUser(User $user): void
    {
        session()->flash('login', 'Connexion réussie');
        $this->response = redirect()->back();
    }

    public function invalidCredentialsProvided(): void
    {
        $this->response = redirect()
                ->back()
                ->withErrors(['credentials' => 'Les identifiants renseignés ne correspondent à aucun utilisateur.']);
    }

    public function response(): Response
    {
        return $this->response;
    }
}
