<?php

declare(strict_types=1);

namespace App\Security\Infrastructure;

use App\Security\Domain\Entities\User;
use App\Security\Domain\Gateways\UserRepository;
use App\Security\Domain\ValueObjects\Email;
use App\Security\Domain\ValueObjects\HashedPassword;
use App\Shared\Infrastructure\Models\User as EloquentUser;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class MysqlUserRepository implements UserRepository
{
    public function exists(Email $email): bool
    {
        return DB::table('users')->where('email', '=', $email->value)->exists();
    }

    public function save(User $user): void
    {
        $user = $user->snapshot();
        EloquentUser::query()->create(['email' => $user->email->value, 'password' => Hash::make($user->password->value)]);
    }

    public function findByEmail(Email $email): User
    {
        return new User(new Email("email"), new HashedPassword("password"));
    }
}
