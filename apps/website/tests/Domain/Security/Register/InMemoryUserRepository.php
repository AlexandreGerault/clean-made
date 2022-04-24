<?php

declare(strict_types=1);

namespace Tests\Domain\Security\Register;

use App\Security\Domain\Entities\User;
use App\Security\Domain\Entities\UserSnapshot;
use App\Security\Domain\Gateways\UserRepository;
use App\Security\Domain\ValueObjects\Email;

class InMemoryUserRepository implements UserRepository
{
    /**
     * @param array<User> $users
     */
    public function __construct(private array $users = [])
    {
    }

    public function exists(Email $email): bool
    {
        foreach ($this->users as $user) {
            if ($user->snapshot()->email->equals($email)) {
                return true;
            }
        }

        return false;
    }

    public function save(User $user): void
    {
        $this->users[] = $user;
    }
}
