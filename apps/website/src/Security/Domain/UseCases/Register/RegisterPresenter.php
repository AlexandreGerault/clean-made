<?php

declare(strict_types=1);

namespace App\Security\Domain\UseCases\Register;

use App\Security\Domain\Entities\User;

interface RegisterPresenter
{
    public function userRegistered(User $user): void;

    public function emailAlreadyInUse(): void;
}
