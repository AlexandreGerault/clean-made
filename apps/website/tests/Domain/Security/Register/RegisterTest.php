<?php

declare(strict_types=1);


namespace Tests\Domain\Security\Register;

use App\Security\Domain\Entities\User;
use Exception;

it('registers a user successfully', function () {
    $sut = RegisterSUT::new()->build()->run();

    $user = $sut->presenter->response()->user();

    expect($user)->toBeInstanceOf(User::class);
    expect($sut->userRepository->exists($user->email))->toBeTrue();
});

it('cannot register a user if the email address is already in use', function () {
    RegisterSUT::new()->emailAlreadyInUse()->build()->run();
})->throws(Exception::class, "This email address is already in use");
