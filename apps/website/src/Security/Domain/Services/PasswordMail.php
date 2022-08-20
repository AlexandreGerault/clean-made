<?php

declare(strict_types=1);

namespace App\Security\Domain\Services;

use App\Security\Domain\Entities\User;

interface PasswordMail
{
    public function makeSubject(): string;

    public function makeContent(User $user): string;
}
