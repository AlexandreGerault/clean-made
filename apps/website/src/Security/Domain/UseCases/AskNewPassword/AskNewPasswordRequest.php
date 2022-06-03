<?php

declare(strict_types=1);

namespace App\Security\Domain\UseCases\AskNewPassword;

class AskNewPasswordRequest
{
    public function __construct(
        public readonly string $to
    ) {
    }
}
