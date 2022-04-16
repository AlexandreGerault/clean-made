<?php

declare(strict_types=1);

namespace Tests\Domain\Security\Register;

use App\Security\Domain\UseCases\Register\RegisterPresenter;
use App\Security\Domain\UseCases\Register\RegisterResponse;

class RegisterTestPresenter implements RegisterPresenter
{
    private RegisterResponse $response;

    public function response(): RegisterResponse
    {
        return $this->response;
    }

    public function userRegistered(RegisterResponse $response): void
    {
        $this->response = $response;
    }

    public function emailAlreadyInUse(): void
    {
        throw new \Exception("This email address is already in use");
    }
}
