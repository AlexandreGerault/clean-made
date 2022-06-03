<?php

declare(strict_types=1);

namespace App\Security\Domain\UseCases\Register;

interface RegisterPresenter
{
    public function userRegistered(RegisterResponse $response): void;

    public function emailAlreadyInUse(): void;
}
