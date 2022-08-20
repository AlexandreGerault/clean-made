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
use Ramsey\Uuid\Uuid;

class MysqlUserRepository implements UserRepository
{
    public function exists(Email $email): bool
    {
        return DB::table('users')->where('email', '=', $email->value)->exists();
    }

    public function save(User $user): void
    {
        $snapshot = $user->snapshot();

        EloquentUser::firstOrCreate(
            ['id' => $snapshot->uuid->toString()],
            ['email' => $snapshot->email->value, 'password' => Hash::make($snapshot->password->value)]
        );
    }

    public function findByEmail(Email $email): User
    {
        $user = EloquentUser::query()->where('email', '=', $email->value)->first();

        return new User(Uuid::fromString($user->id), new Email($user->email), new HashedPassword($user->password));
    }
}
