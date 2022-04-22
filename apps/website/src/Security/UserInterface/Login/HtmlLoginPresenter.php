<?php

declare(strict_types=1);

namespace App\Security\UserInterface\Login;

use App\Security\Domain\Entities\User;
use App\Security\Domain\UseCases\Login\LoginPresenter;
use App\Shared\UserInterface\Http\HttpResponseViewModel;

class HtmlLoginPresenter implements LoginPresenter
{
    private HttpResponseViewModel $viewModel;

    public function successfullyAuthenticatedUser(User $user): void
    {
        session()->flash('login', 'Connexion réussie');
        $this->viewModel = new HttpResponseViewModel(redirect()->back());
    }

    public function invalidCredentialsProvided(): void
    {
        $this->viewModel = new HttpResponseViewModel(
            redirect()
                ->back()
                ->withErrors(['credentials' => 'Les identifiants renseignés ne correspondent à aucun utilisateur.'])
        );
    }

    public function viewModel(): HttpResponseViewModel
    {
        return $this->viewModel;
    }
}
