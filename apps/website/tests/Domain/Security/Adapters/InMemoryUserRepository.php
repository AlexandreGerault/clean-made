<?php

declare(strict_types=1);

namespace Tests\Domain\Security\Adapters;

use App\Security\Domain\Entities\User;
use App\Security\Domain\Gateways\UserRepository;
use App\Security\Domain\ValueObjects\Email;
use App\Security\Domain\ValueObjects\HashedPassword;

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
        foreach ($this->users as $user) {
            if ($user->snapshot()->email->value === $email->value) {
                return true;
            }
        }

        return $this->userExists;
    }

    public function forceUserExists(): void
    {
        $this->userExists = true;
    }

    public function save(User $user): void
    {
        foreach ($this->users as $itrUser) {
            if ($itrUser->snapshot()->email->value === $user->snapshot()->email->value) {
                $this->users[0] = $user;
                return;
            }
        }

        $this->users[] = $user;
    }

    public function contains(User $target): bool
    {
        return false !== current(array_filter($this->users, function (User $user) use ($target) {
            return $user->snapshot()->email->equals($target->snapshot()->email);
        }));
    }

    public function findByEmail(Email $email): User
    {
        foreach ($this->users as $itrUser) {
            if ($itrUser->snapshot()->email->value === $email->value) {
                return $itrUser;
            }
        }

        throw new \RuntimeException('User does not exist');
    }

    public function assertEmailExist(string $email): bool
    {
        return array_reduce($this->users, function (bool $carry, User $user) use ($email) {
            return $carry || $user->snapshot()->email->equals(new Email($email));
        }, false);
    }
}
