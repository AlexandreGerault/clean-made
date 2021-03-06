<?php

declare(strict_types=1);

use App\Security\Domain\Entities\User;
use App\Security\Domain\ValueObjects\Email;
use App\Security\Domain\ValueObjects\HashedPassword;
use App\Security\Infrastructure\MysqlUserRepository;
use Illuminate\Support\Facades\DB;
use function Pest\Laravel\assertDatabaseHas;

it('returns false when email is not present', function () {
    $repository = new MysqlUserRepository();

    expect($repository->exists(new Email('not-present@email')))->toBeFalse();
})->group('check it can check if a user exists');

it('returns true when an email is present', function () {
    DB::table('users')->insert(['email' => 'present@email', 'password' => 'password']);

    $repository = new MysqlUserRepository();

    expect($repository->exists(new Email('present@email')))->toBeTrue();
})->group('check it can check if a user exists');

it('saves a user to the database', function () {
    $repository = new MysqlUserRepository();
    $user = new User(new Email('user@email'), new HashedPassword('password'));

    $repository->save($user);

    assertDatabaseHas('users', ['email' => 'user@email']);
});
