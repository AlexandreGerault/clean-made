<?php

declare(strict_types=1);

namespace App\Security\Infrastructure;

use App\Security\Domain\Entities\User;
use App\Security\Domain\Services\PasswordMail;

class PasswordMailable implements PasswordMail
{
    public function makeContent(User $user): string
    {
        return view('security.mails.new-password')->render();
    }

    public function makeSubject(): string
    {
        /** @var string $subject */
        $subject = __('New password');

        return $subject;
    }
}
