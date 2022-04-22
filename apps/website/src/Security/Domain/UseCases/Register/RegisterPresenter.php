<?php

declare(strict_types=1);

namespace App\Security\Domain\UseCases\Register;

use App\Shared\UserInterface\Presenter;

interface RegisterPresenter extends Presenter
{
    public function userRegistered(RegisterResponse $response): void;

    public function emailAlreadyInUse(): void;
}
