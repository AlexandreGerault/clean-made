<?php

declare(strict_types=1);

namespace App\Security\Infrastructure;

use App\Security\Domain\Entities\User;
use App\Security\Domain\Services\CredentialsAuthenticator;
use Illuminate\Support\Facades\Auth;

class WebCredentialsAuthenticator implements CredentialsAuthenticator
{
    public function authenticate(string $username, string $password): User|false
    {
        return Auth::attempt(['email' => $username, 'password' => $password])
            ? User::create($username, $password)
            : false;
    }
}
