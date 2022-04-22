<?php

declare(strict_types=1);

namespace App\Security\UserInterface\Register;

use App\Security\Domain\UseCases\Register\RegisterPresenter;
use App\Security\Domain\UseCases\Register\RegisterResponse;
use App\Shared\UserInterface\Http\HttpResponseViewModel;
use App\Shared\UserInterface\ViewModel;

class HtmlRegisterPresenter implements RegisterPresenter
{
    private HttpResponseViewModel $viewModel;

    public function userRegistered(RegisterResponse $response): void
    {
        $this->viewModel = new HttpResponseViewModel(
            redirect()->back()
        );
    }

    public function emailAlreadyInUse(): void
    {
        $this->viewModel = new HttpResponseViewModel(
            redirect()->back()->withErrors(['emails' => "Cette adresse mail n'est pas disponible"])
        );
    }

    public function viewModel(): ViewModel
    {
        return $this->viewModel;
    }
}
