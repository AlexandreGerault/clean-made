<?php

declare(strict_types=1);

use App\Security\Domain\Entities\User;
use App\Security\Domain\ValueObjects\Email;
use App\Security\Domain\ValueObjects\HashedPassword;
use App\Security\Infrastructure\MysqlUserRepository;
use Database\Factories\UserFactory;
use Illuminate\Support\Facades\DB;

use Ramsey\Uuid\Uuid;

use function Pest\Laravel\assertDatabaseCount;
use function Pest\Laravel\assertDatabaseHas;

it('returns false when email is not present', function () {
    $repository = new MysqlUserRepository();

    expect($repository->exists(new Email('not-present@email')))->toBeFalse();
})->group('check it can check if a user exists');

it('returns true when an email is present', function () {
    UserFactory::new()->create(['email' => 'present@email', 'password' => 'password']);

    $repository = new MysqlUserRepository();

    expect($repository->exists(new Email('present@email')))->toBeTrue();
})->group('check it can check if a user exists');

it('saves a user to the database', function () {
    $repository = new MysqlUserRepository();
    $user = new User(Uuid::uuid4(), new Email('user@email'), new HashedPassword('password'));

    $repository->save($user);

    assertDatabaseHas('users', ['email' => 'user@email']);
});

it('updates a user in the database', function () {
    $eloquentUser = UserFactory::new()->create(['email' => 'user@email', 'password' => 'password']);
    $repository = new MysqlUserRepository();

    $user = new User(
        Uuid::fromString($eloquentUser->id),
        new Email('user@email'),
        new HashedPassword('password')
    );

    $repository->save($user);

    assertDatabaseCount('users', 1);
});
