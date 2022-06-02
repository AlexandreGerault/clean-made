<?php

declare(strict_types=1);

namespace Tests\Domain\Security\Register;

use App\Security\Domain\Entities\User;
use App\Security\Domain\Entities\UserSnapshot;
use App\Security\Domain\Gateways\UserRepository;
use App\Security\Domain\ValueObjects\Email;

class InMemoryUserRepository implements UserRepository
{
    private bool $userExists = false;

    /**
     * @param array<User> $users
     */
    public function __construct(private array $users = [])
    {
    }

    public function exists(Email $email): bool
    {
        return $this->userExists;
    }

    public function forceUserExists(): void
    {
        $this->userExists = true;
    }

    public function save(User $user): void
    {
        $this->users[] = $user;
    }

    public function contains(User $user): bool
    {
        return false !== current(array_filter($this->users, function (UserSnapshot $userSnapshot) use ($user) {
            return $userSnapshot->email->equals($user->snapshot()->email);
        }));
    }
}
