<?php

declare(strict_types=1);

use App\Security\Domain\Entities\User;
use App\Security\Infrastructure\MysqlUserRepository;
use App\Security\Infrastructure\WebCredentialsAuthenticator;
use Database\Factories\UserFactory;

it('authenticates user with web guard', function () {
    $user = UserFactory::new()->create();

    $authenticator = new WebCredentialsAuthenticator(new MysqlUserRepository());

    expect($authenticator->authenticate($user->email, 'password'))->toBeInstanceOf(User::class);
});

it('fail to authenticate user with web guard', function () {
    $user = UserFactory::new()->create();

    $authenticator = new WebCredentialsAuthenticator(new MysqlUserRepository());

    expect($authenticator->authenticate($user->email, 'wrong-password'))->toBeFalse();
});
