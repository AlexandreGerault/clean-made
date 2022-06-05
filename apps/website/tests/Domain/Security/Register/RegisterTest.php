<?php

declare(strict_types=1);

namespace Tests\Domain\Security\Register;

use App\Security\Domain\Entities\User;
use Exception;

it('registers a user successfully', function () {
    $sut = RegisterSUT::new()->build()->run();

    expect($sut->presenter->response())->toBe('john-doe@email registered');
    expect($sut->userRepository->assertEmailExist('john-doe@email'))->toBe(true);
});

it('cannot register a user if the email address is already in use', function () {
    $sut = RegisterSUT::new()->emailAlreadyInUse()->build()->run();

    expect($sut->presenter->response())->toBe('email already registered');
});
