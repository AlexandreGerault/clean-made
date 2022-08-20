<?php

declare(strict_types=1);

namespace App\Security\Infrastructure;

use App\Security\Domain\Entities\User;
use App\Security\Domain\Services\ResetPasswordTokenGenerator;
use App\Security\Domain\ValueObjects\ResetPasswordToken;
use Illuminate\Support\Str;

class RandomResetPasswordTokenGenerator implements ResetPasswordTokenGenerator
{
    public function generateTokenForUser(User $user): ResetPasswordToken
    {
        return new ResetPasswordToken(Str::random(32));
    }
}
