<?php

declare(strict_types=1);

namespace App\Security\Infrastructure;

use App\Security\Domain\Entities\UserSnapshot;
use App\Security\Domain\Gateways\UserRepository;
use App\Security\Domain\ValueObjects\Email;
use App\Shared\Infrastructure\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class MysqlUserRepository implements UserRepository
{
    public function exists(Email $email): bool
    {
        return DB::table('users')->where('email', '=', $email->value)->exists();
    }

    public function save(UserSnapshot $user): void
    {
        User::query()->create(['email' => $user->email->value, 'password' => Hash::make($user->password->value)]);
    }
}
