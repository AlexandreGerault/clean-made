<?php

declare(strict_types=1);

namespace App\Security\Infrastructure;

use App\Security\Domain\Entities\User;
use App\Security\Domain\Gateways\UserRepository;
use App\Security\Domain\Services\CredentialsAuthenticator;
use App\Security\Domain\ValueObjects\Email;
use Illuminate\Support\Facades\Auth;

class WebCredentialsAuthenticator implements CredentialsAuthenticator
{
    public function __construct(private readonly UserRepository $userRepository)
    {
    }

    public function authenticate(string $email, string $password): User|false
    {
        return Auth::attempt(['email' => $email, 'password' => $password])
            ? $this->userRepository->findByEmail(new Email($email))
            : false;
    }
}
