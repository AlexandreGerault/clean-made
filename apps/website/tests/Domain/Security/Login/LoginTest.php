<?php

declare(strict_types=1);


namespace Tests\Domain\Security\Login;

use App\Security\Domain\Entities\User;

it('can authenticate a user', function () {
    $sut = LoginSUT::new()->build()->run();

    $user = $sut->presenter->response()->user();

    expect($user)->toBeInstanceOf(User::class);
});

it('fails to authenticate when invalid credentials provided', function () {
    LoginSUT::new()->withInvalidCredentials()->build()->run();
})->throws(\Exception::class, "Invalid credentials provided");
