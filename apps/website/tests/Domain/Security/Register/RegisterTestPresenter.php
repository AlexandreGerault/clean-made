<?php

declare(strict_types=1);

namespace Tests\Domain\Security\Register;

use App\Security\Domain\Entities\User;
use App\Security\Domain\UseCases\Register\RegisterPresenter;

class RegisterTestPresenter implements RegisterPresenter
{
    private string $response;

    public function response(): string
    {
        return $this->response;
    }

    public function userRegistered(User $user): void
    {
        $this->response = $user->snapshot()->email->value.' registered';
    }

    public function emailAlreadyInUse(): void
    {
        $this->response = 'email already registered';
    }
}
