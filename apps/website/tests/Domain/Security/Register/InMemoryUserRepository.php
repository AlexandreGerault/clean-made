<?php

declare(strict_types=1);

namespace Tests\Domain\Security\Register;

use App\Security\Domain\Entities\UserSnapshot;
use App\Security\Domain\Gateways\UserRepository;
use App\Security\Domain\ValueObjects\Email;

class InMemoryUserRepository implements UserRepository
{
    /**
     * @param array<UserSnapshot> $users
     */
    public function __construct(private array $users = [])
    {
    }

    public function exists(Email $email): bool
    {
        foreach ($this->users as $user) {
            if ($user->email->equals($email)) {
                return true;
            }
        }

        return false;
    }

    public function save(UserSnapshot $user): void
    {
        $this->users[] = $user;
    }
}
