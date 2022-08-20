<?php

declare(strict_types=1);

namespace App\Security\Domain\Services;

use App\Security\Domain\Entities\User;
use App\Security\Domain\ValueObjects\ResetPasswordToken;

interface ResetPasswordTokenGenerator
{
    public function generateTokenForUser(User $user): ResetPasswordToken;
}
