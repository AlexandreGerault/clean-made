<?php

declare(strict_types=1);

namespace Tests\Domain\Security\AskNewPassword;

use App\Security\Domain\Entities\User;
use App\Security\Domain\Services\ResetPasswordTokenGenerator;
use App\Security\Domain\ValueObjects\ResetPasswordToken;

class FakeResetPasswordTokenGenerator implements ResetPasswordTokenGenerator
{
    public function generateTokenForUser(User $user): ResetPasswordToken
    {
        return new ResetPasswordToken('token');
    }
}
