<?php

declare(strict_types=1);

namespace Tests\Domain\Security\AskNewPassword;

use App\Security\Domain\Entities\User;
use App\Security\Domain\Services\PasswordMail;

class DummyPasswordMail implements PasswordMail
{
    public function generateContent(User $user): string
    {
        return "New password for {$user->snapshot()->email->value}";
    }
}
