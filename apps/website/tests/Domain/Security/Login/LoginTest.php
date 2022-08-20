<?php

declare(strict_types=1);

namespace Tests\Domain\Security\Login;

it('can authenticate a user', function () {
    $sut = LoginSUT::new()->build()->run();

    expect($sut->presenter->response())->toBe('Successfully authenticated user');
});

it('fails to authenticate when invalid credentials provided', function () {
    $sut = LoginSUT::new()->withInvalidCredentials()->build()->run();

    expect($sut->presenter->response())->toBe('Invalid credentials provided');
});
